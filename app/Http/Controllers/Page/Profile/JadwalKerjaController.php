<?php

namespace App\Http\Controllers\Page\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kreait\Laravel\Firebase\Facades\Firebase;

class JadwalKerjaController extends Controller
{
    private $firebaseAuth;
    private $database;
    private $tablename;

    public function __construct()
    {
        $this->firebaseAuth = Firebase::auth();
        $this->database = Firebase::database();
        $this->tablename = 'jam_kerja';
    }
    public function index(Request $request)
    {
        \Carbon\Carbon::setLocale('id');
        $uid = $request->session()->get('uid');
        $schedules = $this->database->getReference($this->tablename . '/' . $uid)->getValue();

        return view('pages.profile.jadwal_kerja.jam-kerja.index', compact('schedules'));
    }

    public function storeWorkSchedule(Request $request)
    {
        $uid = $request->session()->get('uid');

        $request->validate([
            'day' => 'required|string',
            'waktu_mulai' => 'nullable|string',
            'waktu_selesai' => 'nullable|string',
            'is_holiday' => 'nullable|boolean',
        ]);
        $isHoliday = $request->input('is_holiday', false) == '1';
        if (!$isHoliday) {
            $request->validate([
                'waktu_mulai' => 'required|string',
                'waktu_selesai' => 'required|string',
            ]);
        }

        $scheduleData = [
            'doctor_id' => $uid,
            'day' => $request->day,
            'waktu_mulai' => $isHoliday ? null : $request->waktu_mulai,
            'waktu_selesai' => $isHoliday ? null : $request->waktu_selesai,
            'is_holiday' => $isHoliday,
        ];

        try {
            $this->database->getReference($this->tablename . '/' . $uid)->push($scheduleData);
            return redirect()->back()->with('success', 'Work schedule added successfully');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $uid = $request->session()->get('uid');

        $request->validate([
            'day' => 'required|string',
            'waktu_mulai' => 'nullable|string',
            'waktu_selesai' => 'nullable|string',
            'is_holiday' => 'nullable|boolean',
        ]);

        $isHoliday = $request->input('is_holiday', false) == '1';

        if (!$isHoliday) {
            $request->validate([
                'waktu_mulai' => 'required|string',
                'waktu_selesai' => 'required|string',
            ]);
        }

        $scheduleData = [
            'doctor_id' => $uid,
            'day' => $request->day,
            'waktu_mulai' => $isHoliday ? null : $request->waktu_mulai,
            'waktu_selesai' => $isHoliday ? null : $request->waktu_selesai,
            'is_holiday' => $isHoliday,
        ];

        try {
            $this->database->getReference($this->tablename . '/' . $uid . '/' . $id)->set($scheduleData);
            return redirect()->route('jadwal-kerja')->with('success', 'Work schedule updated successfully');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $uid = request()->session()->get('uid');

        try {
            $this->database->getReference($this->tablename . '/' . $uid . '/' . $id)->remove();
            return redirect()->route('jadwal-kerja')->with('success', 'Work schedule deleted successfully');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
