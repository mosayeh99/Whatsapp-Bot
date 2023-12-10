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
                                "id" => "get-previous-menu",
                                "title" => "Previous Menu"
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

        $this->sendMessageRequestService->__invoke($body);
    }
}
