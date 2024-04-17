<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function sendEmailNotification($announcement, $user)
    {
        $receiver = User::find($announcement->creator_id);
        $data = ['name' => $receiver->email];

        Mail::send(['text' => 'mail'], $data, function ($message) use ($receiver, $user) {
            $message->to($receiver->email, $receiver->name)->subject('Hello');
            $message->from($user->email, $user->name);
        });
    }
}
