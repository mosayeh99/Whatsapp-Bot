<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use JsonException;

class SendMessageRequestService
{
    /**
     * @throws JsonException
     */
    public function sendMessageRequest($body): void
    {
        Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . env('BOT_ACCESS_TOKEN')
        ])->withBody(json_encode($body, JSON_THROW_ON_ERROR))->post(env('BOT_BASE_URL'));
    }
}
