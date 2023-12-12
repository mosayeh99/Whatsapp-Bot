<?php

namespace App\Services;

use App\Models\Client;
use App\Services\ContactsMessages\SendContactsMessageService;
use App\Services\DonationMessages\SendProjectPageLinkService;
use App\Services\DonationMessages\SendProjectsListService;
use App\Services\LiveChatMessages\SendLiveChatConfirmationMessageService;
use App\Services\LiveChatMessages\SendLiveChatMessageService;
use JsonException;

class ChatFlowService
{
    public function __construct(
        public SendWelcomeMessageService              $sendWelcomeMessageService,
        public SendFlowCompletionMessageService       $sendFlowCompletionMessageService,
        public SendMenuReminderMessageService         $sendMenuReminderMessageService,
        public SendLiveChatConfirmationMessageService $sendLiveChatConfirmationMessageService,
        public SendEndChatMessageService              $sendEndChatMessageService,
        public SendContactsMessageService             $sendContactsMessageService,
        public SendLiveChatMessageService             $sendLiveChatMessageService,
        public SendProjectsListService                $sendProjectsListService,
        public SendProjectPageLinkService             $sendProjectPageLinkService,
        public GetMessageService                      $getMessageService
    )
    {
    }

    /**
     * @throws JsonException
     */
    public function sendReply($message)
    {
        $client = Client::updateOrCreate(
            ['phone' => $message['senderNumber']],
            ['name' => $message['senderName']]
        );

        if ($client->expected_next_msg_type === 'interactive' && $message['interactiveType'] === '') {
            $this->sendMenuReminderMessageService->sendMenuReminderMessage($message);
        } elseif ($client->expected_next_msg_type === 'text') {
            $this->sendLiveChatConfirmationMessageService->sendLiveChatConfirmationMessage($message);
            $client->update([
                'expected_next_msg_type' => 'interactive'
            ]);
        } else {
            if ($message['interactiveType'] === 'button_reply') {

                if ($message['id'] === 'get-donations') {
                    $this->sendProjectsListService->sendProjectsList($message);
                } elseif ($message['id'] === 'get-main-menu') {
                    $this->sendWelcomeMessageService->sendWelcomeMessage($message);
                } elseif ($message['id'] === 'get-live-chat') {
                    $this->sendLiveChatMessageService->sendLiveChatMessage($message);
                    $client->update([
                        'expected_next_msg_type' => 'text'
                    ]);
                } elseif ($message['id'] === 'get-contacts') {
                    $this->sendContactsMessageService->sendContactsMessage($message);
                } elseif ($message['id'] === 'end-chat') {
                    $this->sendEndChatMessageService->sendEndChatMessage($message);
                }

            } elseif ($message['interactiveType'] === 'list_reply') {

                $this->sendProjectPageLinkService->sendProjectPageLink($message);
//            $this->sendFlowCompletionMessageService->sendFlowCompletionMessage($message);

            } elseif ($message['interactiveType'] === '') {
                $this->sendWelcomeMessageService->sendWelcomeMessage($message);
                $client->update([
                    'expected_next_msg_type' => 'interactive'
                ]);
            }
        }
    }
}
