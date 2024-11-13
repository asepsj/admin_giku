<?php

namespace App\Http\Controllers\Page\Antrian;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Kreait\Laravel\Firebase\Facades\Firebase;
use App\Http\Controllers\Message\MessagesController;

class JadwalController extends Controller
{
    public function __construct()
    {
        $this->database = Firebase::database();
        $this->tablename = 'antrians';
        $this->userTable = 'users';
    }

    public function index(Request $request)
    {
        $firebaseAuth = Firebase::auth();
        $userId = $request->session()->get('uid');
        $firebaseUser = $firebaseAuth->getUser($userId);
        $userRole = $firebaseUser->customClaims['role'] ?? null;
        $doctor_id = $request->input('doctor_id');
        $date = $request->input('date', \Carbon\Carbon::now()->toDateString());

        if ($userRole === 'admin') {
            $id = $doctor_id;
        } elseif ($userRole === 'dokter') {
            $id = $userId;
        }

        // Fetch antrians based on doctor_id
        $antrians = $this->database->getReference($this->tablename)
            ->orderByChild('doctor_id')->equalTo($id)
            ->getValue() ?? []; // Default to an empty array if no data

        // Fetch users and pasien data
        $users = $this->database->getReference($this->userTable)->getValue() ?? [];

        // Filter antrians by date and status
        $filteredAntrians = array_filter($antrians, function ($antrian) use ($date) {
            return isset($antrian['date']) && $antrian['date'] === $date &&
                isset($antrian['status']) && $antrian['status'] !== 'batal' &&
                $antrian['status'] !== 'selesai';
        });

        // Attach names to antrians
        foreach ($filteredAntrians as &$antrian) {
            $antrian['doctor_name'] = $users[$antrian['doctor_id']]['displayName'] ?? 'Unknown';
        }

        return view('pages.antrian.jadwal.index', ['antrians' => $filteredAntrians]);
    }


    public function update(Request $request, $id)
    {
        $status = $request->input('status', 'berlangsung');
        $catatan = $request->input('catatan', null); 
        $antrianRef = $this->database->getReference($this->tablename . '/' . $id);

        $antrian = $antrianRef->getValue();

        if ($antrian) {
            // Update the status
            $antrian['status'] = $status;

            if ($catatan) {
                // Tambahkan catatan ke data antrian jika ada
                $antrian['catatan'] = $catatan;
            }

            // Save the updated data back to Firebase
            $antrianRef->update(['status' => $status, 'catatan' => $catatan]);

            $userKey = $antrian['pasien_id'];
            $user = $this->database->getReference('pasiens' . '/' . $userKey)->getValue();

            $messageTitle = 'Update Antrian';
            $messageContent = $this->generateMessageContent($user['displayName'], $status);

            // Send notification to the patient
            $messagesController = new MessagesController();
            $messagesController->send($request->merge(['title' => $messageTitle, 'message' => $messageContent]), $user['fcmToken']);

            // Store the notification in Firebase Realtime Database
            $this->storeNotificationInFirebase($userKey, $messageTitle, $messageContent);

            return redirect()->back()->with('success', 'Status antrian telah diperbarui menjadi ' . $status . '.');
        }

        return redirect()->back()->with('error', 'Antrian tidak ditemukan.');
    }

    protected function storeNotificationInFirebase($pasienId, $title, $message)
    {
        $notificationRef = $this->database->getReference('notifications/' . $pasienId);

        $notificationData = [
            'pasien_id' => $pasienId,
            'title' => $title,
            'message' => $message,
            'timestamp' => \Carbon\Carbon::now()->timestamp,
            'read' => false
        ];

        $notificationRef->push($notificationData);
    }

    protected function generateMessageContent($pasienName, $status)
    {
        switch ($status) {
            case 'selesai':
                return "Hallo $pasienName, status antrian anda telah selesai. Terima kasih telah menggunakan layanan kami.";
            case 'berlangsung':
                return "Hallo $pasienName, status antrian anda sekarang berlangsung. Mohon bersiap untuk giliran Anda.";
            case 'diterima':
                return "Hallo $pasienName, status antrian anda telah diterima. Silakan datang ke lokasi.";
            default:
                return "Hallo $pasienName, status antrian anda telah diperbarui menjadi $status. Silakan periksa status terbaru antrian anda di aplikasi.";
        }
    }
}
