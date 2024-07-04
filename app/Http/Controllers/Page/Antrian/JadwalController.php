<?php

namespace App\Http\Controllers\Page\Antrian;

use App\Models\Antrian;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $tanggal_antrian = $request->input('tanggal_antrian', Carbon::now()->toDateString());
        $user = Auth::user();
        $role = $user->role;
        
        if ($role === 'doctor') {
            $doctor_id = $user->id;
        } else {
            $doctor_id = $request->input('doctor_id');
        }
        
        $antrians = Antrian::where('tanggal_antrian', $tanggal_antrian)
                            ->where('doctor_id', $doctor_id)
                            ->whereNotIn('status', ['selesai', 'batal'])
                            ->whereIn('nombor_antrian', [1, 2, 3, 4, 5])
                            ->orderBy('nombor_antrian', 'asc')
                            ->get();

        return view('pages.antrian.jadwal.index', compact('antrians'));
    }

    public function update(Request $request, $id)
    {
        $antrian = Antrian::findOrFail($id);
        $antrian->status = $request->input('status', 'berlangsung');
        $antrian->save();

        return redirect()->back()->with('success', 'Status antrian telah diperbarui menjadi berlangsung.');
    }
}
