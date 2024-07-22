<?php

namespace App\Http\Controllers\Page\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Kreait\Laravel\Firebase\Facades\Firebase;

class PasswordController extends Controller
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
            return view('pages.profile.setting.index');
    }

    public function changePassword(Request $request)
    {
        $uid = $request->session()->get('uid');

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $properties = [
            'password' => $request->password,
        ];
        $updateData = [
            'password'=> Hash::make($request->password),
        ];

        try {
            $this->firebaseAuth->updateUser($uid, $properties);
            $this->database->getReference($this->tablename . '/' . $uid)->update($updateData);
            return redirect()->back()->with('success', 'Berhasil mengupdate data');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update user in Firebase Database: ' . $e->getMessage()]);
        }
    }
}
