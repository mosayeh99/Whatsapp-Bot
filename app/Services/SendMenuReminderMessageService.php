<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use JsonException;

class SendMenuReminderMessageService
{
    public function __construct(public SendMessageRequestService $sendMessageRequestService)
    {
    }

    /**
     * @throws JsonException
     */
    public function sendMenuReminderMessage($message): void
    {
        $body = [
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => $message['senderNumber'],
            "type" => "text",
            "text" => [
                "preview_url" => false,
                "body" => "Please choose from the options provided earlier. Simply click on the buttons for a faster response."
            ]
        ];

        $this->sendMessageRequestService->sendMessageRequest($body);
    }
}
