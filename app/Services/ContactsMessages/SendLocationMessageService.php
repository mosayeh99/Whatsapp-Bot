<?php

namespace App\Services\ContactsMessages;

use App\Services\SendMessageRequestService;
use JsonException;

class SendLocationMessageService
{
    public function __construct(public SendMessageRequestService $sendMessageRequestService)
    {
    }

    /**
     * @throws JsonException
     */
    public function sendLocationMessage($message): void
    {
        $body = [
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => $message['senderNumber'],
            "type" => "location",
            "location" => [
                "latitude" => "40.8220369",
                "longitude" => "-74.1305663",
                "name" => "Africa Relief Office",
                "address" => "65 Kingsland Ave #2, Clifton, NJ 07014, USA"
            ]
        ];

        $this->sendMessageRequestService->sendMessageRequest($body);
    }
}
