<?php

namespace App\Services;

use App\Models\Message;

class MessageService
{
    public function sendMessage($senderId, $receiverId, $responseId, $content)
    {
        $message = new Message();
        $message->sender_id = $senderId;
        $message->receiver_id = $receiverId;
        $message->response_id = $responseId;
        $message->content = $content;
        $message->save();
    }
}
