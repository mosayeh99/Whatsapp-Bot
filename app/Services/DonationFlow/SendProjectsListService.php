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
                    "text" => ""
                ],
                "body" => [
                    "text" => "Empower Change: Make a Difference Today!\nChoose from the project menu."
                ],
                "footer" => [
                    "text" => ""
                ],
                "action" => [
                    "button" => "Press here",
                    "sections" => [
                        [
                            "title" => "Our Projects",
                            "rows" => [
                                [
                                    "id" => "get-crisis-projects",
                                    "title" => "Crisis",
                                    "description" => "Amid crisis, unite in compassion. Your donation restores hope, lives."
                                ],
                                [
                                    "id" => "get-water-projects",
                                    "title" => "Water",
                                    "description" => "Provide clean water, support 200-400 lives with sustainable wells."
                                ],
                                [
                                    "id" => "get-education-projects",
                                    "title" => "Education",
                                    "description" => "Sponsor students, shape destinies, and empower dreams in Africa."
                                ],
                                [
                                    "id" => "get-food-aid-projects",
                                    "title" => "Food Aid",
                                    "description" => "Unite against hunger in Africa! Your donation creates lasting impact."
                                ],
                                [
                                    "id" => "get-medical-help-projects",
                                    "title" => "Medical Help",
                                    "description" => "Donate for quality healthcare in Africa. Transform hope into action."
                                ],
                                [
                                    "id" => "get-orphans-projects",
                                    "title" => "Orphan Sponsorship",
                                    "description" => "Orphans' needs surge; support wanes. Help bridge the gap."
                                ],
                                [
                                    "id" => "get-zakat-projects",
                                    "title" => "Zakat",
                                    "description" => "Zakat nurtures Africa projects, fostering hope in communities."
                                ],
                                [
                                    "id" => "get-ramadan-projects",
                                    "title" => "Ramadan",
                                    "description" => "Iftar meal fosters unity, kindness, creating bonds beyond hunger."
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
