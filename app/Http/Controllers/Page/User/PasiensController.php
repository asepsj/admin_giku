<?php

namespace App\Http\Controllers\Page\User;

use App\Models\Pasien;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kreait\Firebase\Contract\Database;
use Illuminate\Support\Facades\Storage;
use Kreait\Firebase\Contract\Messaging;
use Illuminate\Support\Facades\Hash;
use Kreait\Laravel\Firebase\Facades\Firebase;

class PasiensController extends Controller
{
    private $firebaseAuth;
    public function __construct(Database $database, Messaging $messaging)
    {
        $this->database = $database;
        $this->tablename = 'pasiens';
        $this->messaging = $messaging;
        $this->firebaseAuth = Firebase::auth();
    }

    public function index(Request $request)
    {
        $search = $request->input('table_search');

        if ($search) {
            $users = $this->database->getReference($this->tablename)
                ->orderByChild('displayName')
                ->startAt($search)
                ->endAt($search . "\uf8ff")
                ->getValue();
        } else {
            $users = $this->database->getReference($this->tablename)->getValue();
        }

        return view('pages.users.pasien.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'displayName' => 'required|string|max:255',
            'phoneNumber' => 'required|string|min:10|max:15',
        ]);

        $email = $request->input('email');
        $displayName = $request->input('displayName');
        $phoneNumber = $request->input('phoneNumber');
        $password = '12121212';

        try {
            $createdUser = $this->firebaseAuth->createUserWithEmailAndPassword($email, $password);
            $uid = $createdUser->uid;
            $userData = [
                'email' => $email,
                'password' => Hash::make($password),
                'displayName' => $displayName,
                'phoneNumber' => $phoneNumber,
            ];
            $this->firebaseAuth->updateUser($uid, ['displayName' => $displayName]);
            $this->database->getReference($this->tablename . '/' . $uid)->set($userData);
            return redirect()->back()->with('success', 'Berhasil menambahkan pasien');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $key = $id;
        $users = $this->database->getReference($this->tablename)->getChild($key)->getValue();
        return view('pages.users.pasien.edit', compact('users', 'key'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'displayName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'alamat' => 'nullable|string|max:255',
            'phoneNumber' => 'nullable|string|max:15',
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
            $this->firebaseAuth->updateUser($id, $properties);
            $this->database->getReference($this->tablename . '/' . $id)->update($updateData);
            return redirect()->route('pasiens')->with('success', 'Berhasil mengupdate data');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update user in Firebase Database: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $this->firebaseAuth->deleteUser($id);
            $this->database->getReference($this->tablename . '/' . $id)->remove();
            return redirect()->back()->with('success', 'User berhasil di hapus');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function show($id)
    {
        // Temukan pasien berdasarkan ID
        $pasien = Pasien::findOrFail($id);

        // Kirim data pasien ke tampilan blade
        return view('pages.users.pasien.show', compact('pasien'));
    }
}
