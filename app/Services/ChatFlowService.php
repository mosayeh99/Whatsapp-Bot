<?php

namespace App\Services;

use App\Services\DonationFlow\SendProjectPageLinkService;
use App\Services\DonationFlow\SendProjectsListService;
use JsonException;

class ChatFlowService
{
    public function __construct(
        public SendWelcomeMessageService  $sendWelcomeMessageService,
        public SendEndChatMessageService  $sendEndChatMessageService,
        public SendProjectsListService    $sendProjectsListService,
        public SendProjectPageLinkService $sendProjectPageLinkService,
        public GetMessageService          $getMessageService
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
            } elseif ($message['id'] === 'get-main-menu') {

            } elseif ($message['id'] === 'get-contacts') {

            }elseif ($message['id'] === 'end-chat') {

            }

        } elseif ($message['interactiveType'] === 'list_reply') {

            $this->sendProjectPageLinkService->sendProjectPageLink($message);
            $this->sendEndChatMessageService->sendEndChatMessage($message);

        } else {
            $this->sendWelcomeMessageService->sendWelcomeMessage($message);
        }
    }
}
