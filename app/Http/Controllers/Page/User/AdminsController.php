<?php

namespace App\Http\Controllers\Page\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\Contract\Database;
use Illuminate\Support\Facades\Storage;
use Kreait\Laravel\Firebase\Facades\Firebase;

class AdminsController extends Controller
{
    private $firebaseAuth;
    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename = 'users';
        $this->firebaseAuth = Firebase::auth();
    }

    public function index(Request $request)
    {
        $role = $request->query('role', 'admin');
        $search = $request->query('table_search');

        try {
            $query = $this->database->getReference($this->tablename)->orderByChild('role')->equalTo($role);

            if ($search) {
                $users = array_filter($query->getValue(), function ($user) use ($search) {
                    return stripos($user['displayName'] ?? '', $search) !== false;
                });
            } else {
                $users = $query->getValue();
            }

            return view('pages.users.admin.index', compact('users'));
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
                'role' => 'admin',
            ];
            $this->firebaseAuth->updateUser($uid, ['displayName' => $displayName]);
            $this->firebaseAuth->setCustomUserClaims($uid, ['role' => 'admin']);
            $this->database->getReference($this->tablename . '/' . $uid)->set($userData);
            return redirect()->back()->with('success', 'Berhasil menambahkan admin');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        $key = $id;
        $users = $this->database->getReference($this->tablename)->getChild($key)->getValue();
        return view('pages.users.admin.edit', compact('users', 'key'));
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
            return redirect()->route('admins')->with('success', 'Berhasil mengupdate data');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to update user in Firebase Database: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $this->firebaseAuth->deleteUser($id);
            $this->database->getReference($this->tablename . '/' . $id)->remove();
            return redirect()->back()->with('success', 'Admin berhasil di hapus');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
