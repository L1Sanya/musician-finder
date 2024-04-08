<?php

namespace App\Http\Controllers;


use App\Models\Message;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'sender_id' => 'required',
            'receiver_id' => 'required|exists:users,id',
            'response_id' => 'required',
            'content' => 'required|string|max:255',
        ]);

        // Создание нового сообщения
        $message = new Message();
        $message->sender_id = $request->input('sender_id');
        $message->receiver_id = $request->input('receiver_id');
        $message->response_id = $request->input('response_id');
        $message->content = $request->input('content');
        $message->save();

        // Перенаправление пользователя обратно на предыдущую страницу
        return redirect()->back()->with('success', 'Message sent successfully');
    }

}
