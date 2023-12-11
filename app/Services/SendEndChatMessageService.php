<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use JsonException;

class SendEndChatMessageService
{
    public function __construct(public SendMessageRequestService $sendMessageRequestService)
    {
    }

    /**
     * @throws JsonException
     */
    public function sendEndChatMessage($message): void
    {
        $body = [
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => $message['senderNumber'],
            "type" => "text",
            "text" => [
                "preview_url" => false,
                "body" => "Thanks you for using Africa Relief WhatsApp service."
            ]
        ];

        $this->sendMessageRequestService->sendMessageRequest($body);
    }
}
