<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\Contract\Database;
use Kreait\Laravel\Firebase\Facades\Firebase;

class RegisterController extends Controller
{
    private $firebaseAuth;
    private $database;
    private $tablename;
    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename = 'users';
        $this->firebaseAuth = Firebase::auth();
    }
    public function index(Request $request)
    {
        $uid = $request->session()->get('firebase_id_token');
        if ($uid) {
            return redirect()->intended('/dashboard');
        }
        return view('auth.register.index');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'displayName' => 'required|string|max:255',
            'phoneNumber' => 'required|string|min:10|max:15',
            'password' => 'required|string|min:6',
        ]);
        $email = $request->input('email');
        $displayName = $request->input('displayName');
        $phoneNumber = $request->input('phoneNumber');
        $password = $request->input('password');
        $properties = [
            'displayName' => $displayName,
        ];
        $userData = [
            'email' => $email,
            'password' => Hash::make($password),
            'displayName' => $displayName,
            'phoneNumber' => $phoneNumber,
            'role' => 'admin',
        ];

        try {
            $createdUser = $this->firebaseAuth->createUserWithEmailAndPassword($email, $password);
            $uid = $createdUser->uid;
            $this->firebaseAuth->updateUser($uid, $properties);
            $this->firebaseAuth->setCustomUserClaims($uid, ['role' => 'admin']);
            $this->database->getReference($this->tablename . '/' . $uid)->set($userData);
            return redirect()->intended('/login')->with('success', 'Berhasil menambahkan akun.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
