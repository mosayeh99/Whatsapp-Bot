<?php

namespace App\Http\Controllers;

use App\Services\ChatFlowService;
use App\Services\GetMessageService;
use App\Services\SendMessageService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct(public ChatFlowService $chatFlowService, public GetMessageService $getMessageService)
    {
    }

    public function ReceivedMessage(Request $request)
    {
        try {
            $message = $this->getMessageService->GetMessage($request);

            $this->chatFlowService->sendReply($message);

//            $this->getMessageService->myConsole($message['type']);

            return response('EVENT_RECEIVED');
        } catch (\Exception $e) {
            return response('EVENT_RECEIVED');
        }
    }
}
