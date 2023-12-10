<?php

namespace App\Services\ContactsMessages;

use App\Services\SendMessageRequestService;
use JsonException;

class SendContactMessageService
{
    public function __construct(public SendMessageRequestService $sendMessageRequestService)
    {
    }

    /**
     * @throws JsonException
     */
    public function sendContactMessage($message): void
    {
        $body = [
            "messaging_product" => "whatsapp",
            "to" => $message['senderNumber'],
            "type" => "contacts",
            "contacts" => [
                [
                    "addresses" => [
                        [
                            "street" => "65 Kingsland Ave, Suite#2",
                            "city" => "Clifton",
                            "state" => "New Jersey",
                            "zip" => "07014",
                            "country" => "USA",
                            "country_code" => "US",
                            "type" => "WORK"
                        ]
                    ],
                    "emails" => [
                        [
                            "email" => "info@arcdus.org",
                            "type" => "WORK"
                        ]
                    ],
                    "name" => [
                        "formatted_name" => "Africa Relief",
                        "first_name" => "Africa",
                        "last_name" => "Relief"
                    ],
                    "phones" => [
                        [
                            "phone" => "+17322462360",
                            "wa_id" => "africa-relief-phone-number",
                            "type" => "WORK"
                        ]
                    ],
                    "urls" => [
                        [
                            "url" => "africa-relief.org",
                            "type" => "Website"
                        ]
                    ]
                ]
            ]
        ];

        $this->sendMessageRequestService->sendMessageRequest($body);
    }
}
