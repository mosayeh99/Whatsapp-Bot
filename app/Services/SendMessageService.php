<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use JsonException;

class SendMessageService
{
    /**
     * @throws JsonException
     */
    private function SendMessageRequest($body): void
    {
        Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . env('BOT_ACCESS_TOKEN')
        ])->withBody(json_encode($body, JSON_THROW_ON_ERROR))->post(env('BOT_BASE_URL'));
    }


    /**
     * @throws JsonException
     */
    public function SendTextMessage($message): void
    {
        $body = [
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => $message['senderNumber'],
            "type" => "text",
            "text" => [
                "preview_url" => false,
                "body" => "Hello : " .$message['senderName']
            ]
        ];

        $this->SendMessageRequest($body);
    }

    /**
     * @throws JsonException
     */
    public function SendReplyButton($message): void
    {
        $body = [
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => $message['senderNumber'],
            "type" => "interactive",
            "interactive" => [
                "type" => "button",
                "body" => [
                    "text" => "Say Hello To"
                ],
                "action" => [
                    "buttons" => [
                        [
                            "type" => "reply",
                            "reply" => [
                                "id" => "mohamed_btn_id",
                                "title" => "Mohamed"
                            ]
                        ],
                        [
                            "type" => "reply",
                            "reply" => [
                                "id" => "elsayeh_btn_id",
                                "title" => "Elsayeh"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $this->SendMessageRequest($body);
    }
}
