<?php

namespace App\Http\Controllers\Message;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->messaging = Firebase::messaging();
    }

    public function send(Request $request, $key)
    {
        $messageContent = $request->input('message');

        // Mengambil pengguna berdasarkan ID ($key)
        $token = $key;

        // Dapatkan token FCM pengguna
        // $token = $user->fcm_token;

        // Buat pesan
        $deviceToken = $token;
        $message = CloudMessage::withTarget('token', $deviceToken)
            ->withNotification(Notification::create('selamat malm', $messageContent))
            ->withData(['key' => 'value']);
        try {
            $this->messaging->send($message);
            return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengirim pesan: ' . $e->getMessage());
        }
    }
}
