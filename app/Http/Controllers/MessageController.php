<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function send(Request $request): RedirectResponse
    {
        $request->validate([
            'sender_id' => 'required',
            'receiver_id' => 'required|exists:users,id',
            'response_id' => 'required',
            'content' => 'required|string|max:255',
        ]);

        Message::sendMessage(
            $request->input('sender_id'),
            $request->input('receiver_id'),
            $request->input('response_id'),
            $request->input('content')
        );

        return redirect()->back()->with('success', 'Message sent successfully');
    }

}
