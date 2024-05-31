<?php

namespace App\Http\Controllers\Page;

use App\Models\Antrian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AntrianController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $antrians = Antrian::paginate(5);
        return view('dashboard.antrian.antrian', ['antrians' => $antrians]);
    }
}
