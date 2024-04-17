<?php

namespace App\Http\Controllers;


use App\Models\Message;
use App\Models\Response;
use App\Services\MessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function send(Request $request,
                         MessageService $messageService)
    {
        $request->validate([
            'sender_id' => 'required',
            'receiver_id' => 'required|exists:users,id',
            'response_id' => 'required',
            'content' => 'required|string|max:255',
        ]);

        $messageService->sendMessage(
            $request->input('sender_id'),
            $request->input('receiver_id'),
            $request->input('response_id'),
            $request->input('content')
        );

        return redirect()->back()->with('success', 'Message sent successfully');
    }

}
