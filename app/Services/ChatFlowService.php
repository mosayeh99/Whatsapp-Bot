<?php

namespace App\Services;

use App\Services\DonationFlow\SendProjectsListService;
use JsonException;

class ChatFlowService
{
    public function __construct(public SendWelcomeMessage $sendWelcomeMessage, public SendProjectsListService $sendProjectsListService)
    {
    }

    /**
     * @throws JsonException
     */
    public function sendReply($message)
    {
        if ($message['type'] === 'interactive') {

            if ($message['id'] === 'get_donations') {
                $this->sendProjectsListService->sendProjectsList($message);
            }

        } else {
            $this->sendWelcomeMessage->__invoke($message);
        }
    }
}
