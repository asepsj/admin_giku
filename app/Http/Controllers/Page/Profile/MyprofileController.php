<?php

namespace App\Http\Controllers\Page\Profile;

use Kreait\Firebase\Auth;
use Kreait\Firebase\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Illuminate\Support\Facades\Storage as LocalStorage;

class MyprofileController extends Controller
{
    private $firebaseAuth;
    private $firebaseStorage;

    public function __construct()
    {
        $this->firebaseAuth = Firebase::auth();
        $this->database = Firebase::database();
        $this->firebaseStorage = Firebase::storage();
        $this->tablename = 'users';
    }

    public function index(Request $request)
    {
        $uid = $request->session()->get('uid');
        $user = $this->database->getReference($this->tablename . '/' . $uid)->getValue();
        return view('pages.profile.myprofile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $uid = $request->session()->get('uid');

        $request->validate([
            'displayName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'alamat' => 'nullable|string|max:255',
            'phoneNumber' => 'nullable|string|max:20',
            'foto' => 'nullable|image|max:2048', // Validate the uploaded image
            'description' => 'nullable|string|max:1000', // Validate the description
        ]);

        $properties = [
            'displayName' => $request->displayName,
            'email' => $request->email,
        ];

        $updateData = [
            'displayName' => $request->displayName,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'phoneNumber' => $request->phoneNumber,
            'description' => $request->description, // Add description to update data
        ];

        try {
            // Handle the photo upload
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $fileName = $uid . '.' . $file->getClientOriginalExtension();
                $localPath = $file->storeAs('tmp', $fileName);
                $firebasePath = 'profile_photos_users/' . $fileName;

                $bucket = $this->firebaseStorage->getBucket();
                $object = $bucket->upload(LocalStorage::get($localPath), [
                    'name' => $firebasePath,
                    'predefinedAcl' => 'publicRead', 
                ]);

                $publicUrl = $object->signedUrl(new \DateTime('+100 years'));

                $properties['photoUrl'] = $publicUrl;

                $updateData['foto'] = $publicUrl;

                LocalStorage::delete($localPath);
            }

            $this->firebaseAuth->updateUser($uid, $properties);
            $this->database->getReference($this->tablename . '/' . $uid)->update($updateData);
            return redirect()->back()->with('success', 'Berhasil mengupdate data');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
