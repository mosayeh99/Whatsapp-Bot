<?php

namespace App\Services\LiveChatMessages;

use App\Services\SendMessageRequestService;
use JsonException;

class SendLiveChatMessageService
{
    public function __construct(public SendMessageRequestService $sendMessageRequestService)
    {
    }

    /**
     * @throws JsonException
     */
    public function sendLiveChatMessage($message): void
    {
        $body = [
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => $message['senderNumber'],
            "type" => "text",
            "text" => [
                "preview_url" => false,
                "body" => "Thanks for contacting us! A presenter will call you shortly. In the meantime, you could share a bit more about your issue for a faster response."
            ]
        ];

        $this->sendMessageRequestService->sendMessageRequest($body);
    }
}
