<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use JsonException;

class SendFlowCompletionMessageService
{
    public function __construct(public SendMessageRequestService $sendMessageRequestService)
    {
    }

    /**
     * @throws JsonException
     */
    public function sendFlowCompletionMessage($message): void
    {
        $body = [
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => $message['senderNumber'],
            "type" => "interactive",
            "interactive" => [
                "type" => "button",
                "body" => [
                    "text" => "Need more help?"
                ],
                "action" => [
                    "buttons" => [
                        [
                            "type" => "reply",
                            "reply" => [
                                "id" => "get-main-menu",
                                "title" => "Main Menu"
                            ]
                        ],
                        [
                            "type" => "reply",
                            "reply" => [
                                "id" => "get-contacts",
                                "title" => "Contact Us"
                            ]
                        ],
                        [
                            "type" => "reply",
                            "reply" => [
                                "id" => "end-chat",
                                "title" => "End Chat"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $this->sendMessageRequestService->sendMessageRequest($body);
    }
}
