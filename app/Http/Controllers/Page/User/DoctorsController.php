<?php

namespace App\Http\Controllers\Page\User;

use App\Models\User;
use App\Models\Klinik;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\Contract\Database;
use Illuminate\Support\Facades\Storage;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Laravel\Firebase\Facades\Firebase;

class DoctorsController extends Controller
{
    private $firebaseAuth;
    public function __construct(Database $database, Messaging $messaging)
    {
        $this->database = $database;
        $this->tablename = 'users';
        $this->messaging = $messaging;
        $this->firebaseAuth = Firebase::auth();
    }

    public function index(Request $request)
    {
        $role = $request->query('role', 'dokter');

        try {
            $users = $this->database->getReference($this->tablename)->orderByChild('role')->equalTo($role)->getValue();
            return view('pages.users.dokter.index', compact('users'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'displayName' => 'required|string|max:255',
            'phoneNumber' => 'required|string|min:10|max:15',
            'alamat' => 'required|string',
        ]);

        $email = $request->input('email');
        $displayName = $request->input('displayName');
        $phoneNumber = $request->input('phoneNumber');
        $alamat = $request->input('alamat');
        $password = '12121212';

        try {
            $createdUser = $this->firebaseAuth->createUserWithEmailAndPassword($email, $password);
            $uid = $createdUser->uid;
            $userData = [
                'email' => $email,
                'password' => Hash::make($password),
                'displayName' => $displayName,
                'phoneNumber' => $phoneNumber,
                'alamat' => $alamat,
                'role' => 'dokter',
            ];
            $this->database->getReference($this->tablename . '/' . $uid)->set($userData);
            return redirect()->back()->with('success', 'Berhasil menambahkan dokter');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $this->firebaseAuth->deleteUser($id);
            $this->database->getReference($this->tablename . '/' . $id)->remove();
            return redirect()->back()->with('success', 'Dokter berhasil di hapus');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $key = $id;
        $users = $this->database->getReference($this->tablename)->getChild($key)->getValue();
        return view('pages.users.dokter.edit', compact('users', 'key'));
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
            return redirect()->route('doctors')->with('success', 'Berhasil mengupdate data');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update user in Firebase Database: ' . $e->getMessage()]);
        }
    }

    public function sendmess($token)
    {
        $deviceToken = $token;
        $message = CloudMessage::withTarget('token', $deviceToken)
            ->withNotification(Notification::create('selamat malm', 'asasasas'))
            ->withData(['key' => 'value']);
        $this->messaging->send($message);
    }
}
