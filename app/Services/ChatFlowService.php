<?php

namespace App\Services;

use App\Services\ContactsMessages\SendContactMessageService;
use App\Services\ContactsMessages\SendLocationMessageService;
use App\Services\DonationMessages\SendProjectPageLinkService;
use App\Services\DonationMessages\SendProjectsListService;
use JsonException;

class ChatFlowService
{
    public function __construct(
        public SendWelcomeMessageService        $sendWelcomeMessageService,
        public SendFlowCompletionMessageService $sendFlowCompletionMessageService,
        public SendEndChatMessageService        $sendEndChatMessageService,
        public SendContactMessageService        $sendContactMessageService,
        public SendLocationMessageService       $sendLocationMessageService,
        public SendProjectsListService          $sendProjectsListService,
        public SendProjectPageLinkService       $sendProjectPageLinkService,
        public GetMessageService                $getMessageService
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
                $this->sendWelcomeMessageService->sendWelcomeMessage($message);
            } elseif ($message['id'] === 'get-contacts') {
                $this->sendContactMessageService->sendContactMessage($message);
                $this->sendLocationMessageService->sendLocationMessage($message);
            } elseif ($message['id'] === 'end-chat') {
                $this->sendEndChatMessageService->sendEndChatMessage($message);
            }

        } elseif ($message['interactiveType'] === 'list_reply') {

            $this->sendProjectPageLinkService->sendProjectPageLink($message);
//            $this->sendFlowCompletionMessageService->sendFlowCompletionMessage($message);

        } else {
            $this->sendWelcomeMessageService->sendWelcomeMessage($message);
        }
    }
}
