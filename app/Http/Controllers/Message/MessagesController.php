<?php

namespace App\Http\Controllers\Message;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class MessagesController extends Controller
{
    protected $messaging;

    public function __construct()
    {
        $this->messaging = Firebase::messaging();
    }

    public function send(Request $request, $deviceToken)
    {
        $messageContent = $request->input('message');
        $messageTitle = $request->input('title');

        $message = CloudMessage::withTarget('token', $deviceToken)
            ->withNotification(Notification::create($messageTitle, $messageContent))
            ->withData(['key' => 'value']);  // Add any additional data if needed

        try {
            $this->messaging->send($message);
            \Log::info('FCM message sent successfully.', [
                'deviceToken' => $deviceToken,
                'title' => $messageTitle,
                'message' => $messageContent
            ]);
            return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
        } catch (\Exception $e) {
            \Log::error('FCM send error: ' . $e->getMessage(), [
                'deviceToken' => $deviceToken,
                'title' => $messageTitle,
                'message' => $messageContent
            ]);
            return redirect()->back()->with('error', 'Gagal mengirim pesan: ' . $e->getMessage());
        }
    }
}
