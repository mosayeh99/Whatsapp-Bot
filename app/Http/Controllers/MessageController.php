<?php

namespace App\Http\Controllers;

use App\Services\GetMessageService;
use App\Services\SendMessageService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct(public SendMessageService $sendMessageService, public GetMessageService $getMessageService)
    {
    }

    public function ReceivedMessage(Request $request)
    {
        try {
            $message = $this->getMessageService->GetMessage($request);

            if ($message['type'] = 'interactive') {
                $this->sendMessageService->SendReplyButton($message);
            } else {
                $this->sendMessageService->SendTextMessage($message);
            }

            $this->getMessageService->myConsole($message['text']);

            return response('EVENT_RECEIVED');
        } catch (\Exception $e) {
            return response('EVENT_RECEIVED');
        }
    }
}
