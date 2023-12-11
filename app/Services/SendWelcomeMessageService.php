<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use JsonException;

class SendWelcomeMessageService
{
    public function __construct(public SendMessageRequestService $sendMessageRequestService)
    {
    }

    /**
     * @throws JsonException
     */
    public function sendWelcomeMessage($message): void
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
                                "id" => "get-live-chat",
                                "title" => "Live Chat"
                            ]
                        ],
                        [
                            "type" => "reply",
                            "reply" => [
                                "id" => "get-contacts",
                                "title" => "Contact Us"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $this->sendMessageRequestService->sendMessageRequest($body);
    }
}
