<?php

namespace App\Http\Controllers\Page\Antrian;

use App\Models\Antrian;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Events\NotificationCreated;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Kreait\Laravel\Firebase\Facades\Firebase;

class JadwalController extends Controller
{
    public function __construct()
    {
        $this->database = Firebase::database();
        $this->tablename = 'antrians';
    }
    public function index(Request $request)
    {
        $id = $request->session()->get('uid');
        $date = $request->input('date', Carbon::now()->toDateString());

        $antrians = $this->database->getReference($this->tablename)->orderByChild('doctor_key')->equalTo($id)->getValue();

        $filteredAntrians = array_filter($antrians, function ($antrian) use ($date) {
            return $antrian['date'] === $date && $antrian['status'] !== 'batal';
        });

        return view('pages.antrian.jadwal.index', ['antrians' => $filteredAntrians]);
    }

    public function update(Request $request, $id)
    {
        $antrian = Antrian::findOrFail($id);
        $antrian->status = $request->input('status', 'berlangsung');
        $antrian->save();

        // Create and send notification
        $notification = Notification::create([
            // 'antrian_id' => $antrian->id,
            // 'user_id' =>  Auth::id(),
            'pasien_id' => $antrian->pasien_id,
            'title' => 'Status Antrian Diperbarui',
            'message' => 'Status antrian Anda telah diperbarui menjadi ' . $antrian->status,
            'is_read' => false,
        ]);
        event(new NotificationCreated($notification));
        return redirect()->back()->with('success', 'Status antrian telah diperbarui menjadi berlangsung.');
    }
}
