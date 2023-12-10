<?php

namespace App\Services;

use App\Services\DonationFlow\SendProjectPageLinkService;
use App\Services\DonationFlow\SendProjectsListService;
use JsonException;

class ChatFlowService
{
    public function __construct(
        public SendWelcomeMessage $sendWelcomeMessage,
        public SendEndChatMessageService $sendEndChatMessageService,
        public SendProjectsListService $sendProjectsListService,
        public SendProjectPageLinkService $sendProjectPageLinkService,
        public GetMessageService $getMessageService
    )
    {
    }

    /**
     * @throws JsonException
     */
    public function sendReply($message)
    {
        if ($message['interactiveType'] === 'button_reply') {

            if ($message['id'] === 'get-donations') {
                $this->sendProjectsListService->sendProjectsList($message);
            }

        } elseif ($message['interactiveType'] === 'list_reply') {

            $this->sendProjectPageLinkService->sendProjectPageLink($message);
            $this->sendEndChatMessageService->sendEndChatMessage($message);

        } else {
            $this->sendWelcomeMessage->__invoke($message);
        }
    }
}
