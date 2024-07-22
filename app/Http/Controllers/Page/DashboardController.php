<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('pages.dashboard.index');
    }
}
