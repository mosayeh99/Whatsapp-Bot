<?php

namespace App\Services\DonationMessages;

use App\Services\SendMessageRequestService;
use Illuminate\Support\Str;
use JsonException;

class SendProjectPageLinkService
{
    public function __construct(public SendMessageRequestService $sendMessageRequestService)
    {
    }

    /**
     * @throws JsonException
     */
    public function sendProjectPageLink($message): void
    {
        $projectSlug = Str::between($message['id'], 'get-', '-project');

        $body = [
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => $message['senderNumber'],
            "type" => "template",
            "template" => [
                "name" => "project_template",
                "language" => [
                    "code" => "en"
                ],
                "components" => [
                    [
                        "type" => "header",
                        "parameters" => [
                            [
                                "type" => "image",
                                "image" => [
                                    "link" => "https://africa-relief.org/wp-content/uploads/2023/12/$projectSlug.jpg"
                                ]
                            ]
                        ]
                    ],
                    [
                        "type" => "body",
                        "parameters" => [
                            [
                                "type" => "text",
                                "text" => Str::ucfirst($projectSlug)
                            ],
                            [
                                "type" => "text",
                                "text" => $message['description'],
                            ]
                        ]
                    ],
                    [
                        "type" => "BUTTON",
                        "sub_type" => "URL",
                        "index" => 0,
                        "parameters" => [
                            [
                                "type" => "TEXT",
                                "text" => $projectSlug
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $this->sendMessageRequestService->sendMessageRequest($body);
    }
}
