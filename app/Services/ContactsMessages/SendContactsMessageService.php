<?php

namespace App\Services\ContactsMessages;

use App\Services\SendMessageRequestService;
use JsonException;

class SendContactsMessageService
{
    public function __construct(public SendMessageRequestService $sendMessageRequestService)
    {
    }

    /**
     * @throws JsonException
     */
    public function SendContactsMessage($message): void
    {
        $body = [
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => $message['senderNumber'],
            "type" => "template",
            "template" => [
                "name" => "contacts_template",
                "language" => [
                    "code" => "en_US"
                ],
                "components" => [
                    [
                        "type" => "header",
                        "parameters" => [
                            [
                                "type" => "location",
                                "location" => [
                                    "latitude" => "40.8220369",
                                    "longitude" => "-74.1305663",
                                    "name" => "Africa Relief Office",
                                    "address" => "65 Kingsland Ave #2, Clifton, NJ 07014, USA"
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $this->sendMessageRequestService->sendMessageRequest($body);
    }
}
