<?php

namespace App\Services;

use App\Services\DonationFlow\SendProjectsListService;
use JsonException;

class ChatFlowService
{
    public function __construct(public SendWelcomeMessage $sendWelcomeMessage, public SendProjectsListService $sendProjectsListService, public GetMessageService $getMessageService)
    {
    }

    /**
     * @throws JsonException
     */
    public function sendReply($message)
    {
        if ($message['type'] === 'interactive') {

            if ($message['id'] === 'get_donations') {
                $this->getMessageService->myConsole($message['type']);
                $this->sendProjectsListService->sendProjectsList($message);
            }

        } else {
            $this->sendWelcomeMessage->__invoke($message);
        }
    }
}
