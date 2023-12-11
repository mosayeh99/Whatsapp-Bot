<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use JsonException;

class SendLiveChatMessageService
{
    public function __construct(public SendMessageRequestService $sendMessageRequestService)
    {
    }

    /**
     * @throws JsonException
     */
    public function sendLiveChatMessage($message): void
    {
        $body = [
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => $message['senderNumber'],
            "type" => "text",
            "text" => [
                "preview_url" => false,
                "body" => "Thanks for contacting us! A presenter will call you shortly. In the meantime, could you share a bit more about your issue for a faster response? Your input helps us assist you better."
            ]
        ];

        $this->sendMessageRequestService->sendMessageRequest($body);
    }
}
