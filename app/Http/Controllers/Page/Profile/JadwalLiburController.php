<?php

namespace App\Http\Controllers\Page\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;

class JadwalLiburController extends Controller
{
    private $firebaseAuth;
    private $database;
    private $holidayTable;

    public function __construct()
    {
        $this->firebaseAuth = Firebase::auth();
        $this->database = Firebase::database();
        $this->holidayTable = 'jadwal_libur';
    }

    public function index(Request $request)
    {
        \Carbon\Carbon::setLocale('id');
        $uid = $request->session()->get('uid');
        $holidays = $this->database->getReference($this->holidayTable . '/' . $uid)->getValue();

        return view('pages.profile.jadwal_kerja.jadwal-libur.index', compact('holidays'));
    }

    public function storeHoliday(Request $request)
    {
        $uid = $request->session()->get('uid');
        $request->validate([
            'tanggal_libur' => 'required|date',
        ]);
        $holidayDate = $request->input('tanggal_libur');
        $holidays = $this->database->getReference($this->holidayTable . '/' . $uid)->getValue();
        if ($holidays && in_array($holidayDate, array_column($holidays, 'tanggal_libur'))) {
            return redirect()->back()->with('error', 'Tanggal liburan ini telah ditambahkan.');
        }
        $holidayData = [
            'doctor_id' => $uid,
            'tanggal_libur' => $holidayDate,
        ];
        try {
            $this->database->getReference($this->holidayTable . '/' . $uid)->push($holidayData);
            return redirect()->back()->with('success', 'Tanggal libur berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($key)
    {
        $uid = session()->get('uid');
        try {
            $this->database->getReference($this->holidayTable . '/' . $uid . '/' . $key)->remove();
            return redirect()->back()->with('success', 'Tanggal libur berhasil dihapus');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request, $key)
    {
        $uid = $request->session()->get('uid');
        $request->validate([
            'tanggal_libur' => 'required|date',
        ]);

        $holidayDate = $request->input('tanggal_libur');
        $holidayData = [
            'doctor_id' => $uid,
            'tanggal_libur' => $holidayDate,
        ];

        try {
            $this->database->getReference($this->holidayTable . '/' . $uid . '/' . $key)->set($holidayData);
            return redirect()->back()->with('success', 'Tanggal libur berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
