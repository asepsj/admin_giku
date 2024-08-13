<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->database = Firebase::database();
        $this->tabledokter = 'users';
        $this->tablepasien = 'pasiens';
        $this->firebaseAuth = Firebase::auth();
    }
    public function index(Request $request)
    {
        $role = $request->query('role', 'dokter');
        $doctors = $this->database->getReference($this->tabledokter)->orderByChild('role')->equalTo($role)->getValue();
        $users = $this->database->getReference($this->tablepasien)->getValue();
        return view('pages.dashboard.index', compact('users','doctors'));
    }
}
