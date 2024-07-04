<?php

namespace App\Http\Controllers\Page\Antrian;

use App\Models\Antrian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $antrians = Antrian::where('doctor_id', $user->id)
                ->whereIn('status', ['selesai', 'batal'])
                ->orderBy('created_at', 'desc')
                ->paginate(5);

        return view('pages.antrian.riwayat.index', compact('antrians'));
    }
}
