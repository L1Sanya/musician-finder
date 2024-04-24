<?php

namespace App\Services;

use App\Models\Message;

class MessageService
{
    public function sendMessage($senderId, $receiverId, $responseId, $content): void
    {
        Message::create([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'response_id' => $responseId,
            'content' => $content,
        ]);
    }
}
