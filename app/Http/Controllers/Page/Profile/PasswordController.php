<?php

namespace App\Http\Controllers\Page\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function index()
    {
        return view('pages.profile.setting.index');
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('profile.setting')->with('success', 'Password changed successfully');
    }
}
