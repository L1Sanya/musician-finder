<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Message;
use App\Models\Response;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function send(Request $request, Announcement $announcement, Response $response)
    {

    }


    public function show(Request $request, User $receiver)
    {

        $user = auth()->user();

        $messages = Message::where(function ($query) use ($user, $receiver) {
            $query->where('sender_id', $user->id)->where('receiver_id', $receiver->id);
        })->orWhere(function ($query) use ($user, $receiver) {
            $query->where('sender_id', $receiver->id)->where('receiver_id', $user->id);
        })->orderBy('created_at', 'asc')->get();


        return view('dialogs', [
            'messages' => $messages,
            'receiver_id' => $receiver,
        ]);
    }
}
