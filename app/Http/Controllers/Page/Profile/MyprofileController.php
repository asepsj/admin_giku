<?php

namespace App\Http\Controllers\Page\Profile;

use App\Models\Klinik;
use Kreait\Firebase\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Kreait\Laravel\Firebase\Facades\Firebase;

class MyprofileController extends Controller
{
    private $firebaseAuth;

    public function __construct()
    {
        $this->firebaseAuth = Firebase::auth();
        $this->database = Firebase::database();
        $this->tablename = 'users';
    }

    public function index(Request $request)
    {
            return view('pages.profile.myprofile.index');
    }

    public function update(Request $request)
    {
        $uid = $request->session()->get('uid');

        $request->validate([
            'displayName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            // 'foto' => 'nullable|image|max:2048',
            'alamat' => 'nullable|string|max:255',
            'phoneNumber' => 'nullable|string|max:20',
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
        ];
        try {
            $this->firebaseAuth->updateUser($uid, $properties);
            $this->database->getReference($this->tablename . '/' . $uid)->update($updateData);
            return redirect()->back()->with('success', 'Berhasil mengupdate data');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
