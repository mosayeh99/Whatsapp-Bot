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
            "to" => $message['senderNumber'],
            "text" => [
                "preview_url" => true,
                "body" => "Please visit https://africa-relief.org/project-category/$projectSlug to donate."
            ]
        ];

        $this->sendMessageRequestService->sendMessageRequest($body);
    }
}
