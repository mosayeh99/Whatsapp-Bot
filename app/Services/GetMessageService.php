<?php

namespace App\Services;

use Illuminate\Http\Request;
use JsonException;

class GetMessageService
{
    /**
     * @throws JsonException
     */
    public function GetMessage(Request $request): array
    {
        $msgObject = json_decode($request->getContent(), false, 512, JSON_THROW_ON_ERROR);
        $msgValueObject = $msgObject->entry[0]->changes[0]->value;
        $senderName = $msgValueObject->contacts[0]->profile->name;
        $message = $msgValueObject->messages[0];
        $senderNumber = $message->from;

        $messageId = '';
        $messageType = $message->type;
        $interactiveType = '';
        $listReplyDescription = '';

        if ($messageType === 'interactive') {
            $interactiveObject = $message->interactive;
            $interactiveType = $interactiveObject->type;

            if ($interactiveType === 'button_reply') {
                $messageId = $interactiveObject->button_reply->id;
            } elseif ($interactiveType === 'list_reply') {
                $messageId = $interactiveObject->list_reply->id;
                $listReplyDescription = $interactiveObject->list_reply->description;
            } else {
                $this->myConsole('Wrong Message');
            }
        } elseif ($messageType === 'button') {
            $interactiveType = 'button_reply';
            $messageId = 'get-main-menu';
        } else {
            $this->myConsole('Wrong Message');
        }

        return [
            'interactiveType' => $interactiveType,
            'id' => $messageId,
            'description' => $listReplyDescription,
            'senderName' => $senderName,
            'senderNumber' => $senderNumber
        ];
    }

    public function myConsole($data): void
    {
        $appendVar = fopen(public_path('text.txt'), 'ab');
        fwrite($appendVar, $data);
        fclose($appendVar);
    }
}
