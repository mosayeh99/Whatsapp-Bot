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
            "type" => "interactive",
            "interactive" => [
                "type" => "button",
                "body" => [
                    "text" => "Please choose from the previous menu.\nTo explore different choices, click the 'Main Menu' button."
                ],
                "action" => [
                    "buttons" => [
                        [
                            "type" => "reply",
                            "reply" => [
                                "id" => "get-main-menu",
                                "title" => "Main Menu"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $this->sendMessageRequestService->sendMessageRequest($body);
    }
}
