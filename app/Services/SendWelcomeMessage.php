<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use JsonException;

class SendWelcomeMessage
{
    public function __construct(public SendMessageRequestService $sendMessageRequestService)
    {
    }

    /**
     * @throws JsonException
     */
    public function __invoke($message): void
    {
        $body = [
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => $message['senderNumber'],
            "type" => "interactive",
            "interactive" => [
                "type" => "button",
                "body" => [
                    "text" => "Welcome " .$message['senderName'] . " to Africa Relief whatsApp service. \nHow can we help you?"
                ],
                "action" => [
                    "buttons" => [
                        [
                            "type" => "reply",
                            "reply" => [
                                "id" => "get-donations",
                                "title" => "Donate"
                            ]
                        ],
                        [
                            "type" => "reply",
                            "reply" => [
                                "id" => "get-donor-care",
                                "title" => "Donor Care"
                            ]
                        ],
                        [
                            "type" => "reply",
                            "reply" => [
                                "id" => "get-contact-details",
                                "title" => "Contact Us"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $this->sendMessageRequestService->__invoke($body);
    }
}
