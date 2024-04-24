<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function sendEmailNotification($announcement, $user): void
    {
        $receiverEmail = User::find($announcement->creator_id)->email;
        $receiverName = User::find($announcement->creator_id)->name;
        $data = array('name' => $receiverEmail);

        Mail::send(['text' => 'mail'], $data, function($message) use ($receiverEmail, $user, $receiverName) {
            $message->to($receiverEmail, $receiverName)->subject('Hello');
            $message->from($user->email, $user->name);
        });
    }
}
