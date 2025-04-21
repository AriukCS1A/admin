<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FirebaseService
{
    protected string $broadcastUrl;

    public function __construct()
    {
        // .env файлаас URL авах, байхгүй бол default localhost URL
        $this->broadcastUrl = env('NODE_SERVER_BROADCAST_URL', 'http://10.0.2.2:3000/sendBroadcastNotification');
    }

    /**
     * Firebase push мэдэгдэл Node серверээр дамжуулан илгээх
     *
     * @param string $title
     * @param string $body
     * @return array
     */
    public function sendBroadcastNotification(string $title, string $body): array
    {
        try {
            $response = Http::post($this->broadcastUrl, [
                'title' => $title,
                'body' => $body,
            ]);

            if ($response->successful()) {
                Log::info('✅ Firebase broadcast амжилттай:', $response->json());
                return $response->json();
            } else {
                Log::error('🚫 Firebase broadcast амжилтгүй:', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                return ['error' => 'Firebase мэдэгдэл илгээхэд алдаа гарлаа.'];
            }
        } catch (\Throwable $e) {
            Log::error('🔥 FirebaseService Exception:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return ['error' => 'Сервертэй холбогдож чадсангүй.'];
        }
    }

    public function sendToTopic(string $title, string $body, string $topic, array $data = []): array
{
    try {
        $response = Http::post($this->broadcastUrl, [
            'title' => $title,
            'body' => $body,
            'topic' => $topic,
            'data' => $data,
        ]);

        if ($response->successful()) {
            Log::info('✅ Firebase topic илгээгдлээ:', $response->json());
            return $response->json();
        } else {
            Log::error('🚫 Firebase topic илгээхэд алдаа:', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            return ['error' => 'Topic мэдэгдэл илгээхэд алдаа гарлаа.'];
        }
    } catch (\Throwable $e) {
        Log::error('🔥 FirebaseService topic Exception:', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);
        return ['error' => 'Topic илгээх үед сервертэй холбогдож чадсангүй.'];
    }
}

}
