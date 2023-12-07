<?php

namespace App\Services\DonationFlow;

use App\Services\SendMessageRequestService;
use JsonException;

class SendProjectsListService
{
    public function __construct(public SendMessageRequestService $sendMessageRequestService)
    {
    }

    /**
     * @throws JsonException
     */
    public function sendProjectsList($message): void
    {
        $body = [
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => $message['senderNumber'],
            "type" => "interactive",
            "interactive" => [
                "type" => "list",
                "header" => [
                    "type" => "text",
                    "text" => "Please select a project"
                ],
                "body" => [
                    "text" => "<BODY_TEXT>"
                ],
                "footer" => [
                    "text" => "<FOOTER_TEXT>"
                ],
                "action" => [
                    "button" => "Press here",
                    "sections" => [
                        [
                            "title" => "Our Projects",
                            "rows" => [
                                [
                                    "id" => "get_crisis_projects",
                                    "title" => "Crisis",
                                    "description" => "Amid crisis, unite in compassion. Your donation, big or small, is a beacon of hope, restoring lives."
                                ],
                                [
                                    "id" => "get_water_projects",
                                    "title" => "Water",
                                    "description" => "Provide easy access to clean water for the village, supports 200-400 individuals."
                                ],
                                [
                                    "id" => "get_education_projects",
                                    "title" => "Education",
                                    "description" => "Your support propels, enabling education for all and fostering a more empowered, educated Africa."
                                ],
                                [
                                    "id" => "get_food_aid_projects",
                                    "title" => "Food Aid",
                                    "description" => "Let’s Unite to Ensure No Neighbor Goes Hungry. In Africa, Two-Thirds Struggle with Food Insecurity."
                                ],
                                [
                                    "id" => "get_medical_projects",
                                    "title" => "Medical Help",
                                    "description" => "Your support fuels health initiatives in Africa for communities in need and empowers wellness."
                                ],
                                [
                                    "id" => "get_orphans_projects",
                                    "title" => "Orphan Sponsorship",
                                    "description" => "Sponsor an orphan in Africa, weaving a tapestry of care. Your support is a gift of hope."
                                ],
                                [
                                    "id" => "get_zakat_projects",
                                    "title" => "Zakat",
                                    "description" => "See your impact within providing your Zakat and support vital projects in Africa."
                                ],
                                [
                                    "id" => "get_ramadan_projects",
                                    "title" => "Ramadan",
                                    "description" => "Support our If-tar meals in Africa. Your contribution brings together hearts and plates for a meaningful Ramadan."
                                ],
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $this->sendMessageRequestService->__invoke($body);
    }
}
