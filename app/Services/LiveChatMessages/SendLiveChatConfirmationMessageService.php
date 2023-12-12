<?php

namespace App\Services\LiveChatMessages;

use App\Services\SendMessageRequestService;
use Illuminate\Support\Facades\Http;
use JsonException;

class SendLiveChatConfirmationMessageService
{
    public function __construct(public SendMessageRequestService $sendMessageRequestService)
    {
    }

    /**
     * @throws JsonException
     */
    public function sendLiveChatConfirmationMessage($message): void
    {
        $body = [
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => $message['senderNumber'],
            "type" => "interactive",
            "interactive" => [
                "type" => "button",
                "body" => [
                    "text" => "Thank you for reaching out to us! We've received your message and will get back to you shortly."
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
