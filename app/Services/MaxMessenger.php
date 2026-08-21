<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MaxMessenger
{
    protected string $token;
    protected string $baseUrl;
    protected ?string $chatId;
    protected ?string $userId;

    public function __construct()
    {
        $this->token   = config('services.max.token');
        $this->baseUrl = rtrim(config('services.max.base_url'), '/');
        $this->chatId  = config('services.max.chat_id'); // на будущее
        $this->userId  = config('services.max.user_id'); // используем сейчас
    }

    public function sendMessage(string $text): bool
    {
        try {
            // ДЛЯ ЛИЧНОГО ЧАТА: отправляем по user_id
            $url = $this->baseUrl . '/messages?user_id=' . $this->userId;

            $response = Http::withoutVerifying()
                ->withHeaders([
                    'Authorization' => $this->token,
                    'Content-Type'  => 'application/json',
                ])
                ->post($url, [
                    'text' => $text,
                ]);

            if (! $response->successful()) {
                Log::error('MAX API error', [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);
                return false;
            }

            return true;
        } catch (\Throwable $e) {
            Log::error('MAX API exception: ' . $e->getMessage());
            return false;
        }
    }
}
