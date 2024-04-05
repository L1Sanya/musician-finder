<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Message;
use App\Models\Response;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function send(Request $request)
    {
        // Проверяем аутентификацию пользователя
        if (Auth::check()) {
            // Получаем текущего пользователя
            $user = auth()->user();
            $responseId = $request->input('response_id');
            $receiverId = $request->input('receiver_id');

            // Проверяем, является ли пользователь либо создателем объявления, либо пользователем с резюме, который откликнулся
            $isAllowed = ($user->id == $responseId || $user->id == $receiverId);

            if ($isAllowed) {
                // Создаем новое сообщение
                $message = new Message();
                $message->sender_id = $user->id;
                $message->receiver_id = $receiverId;
                $message->response_id = $responseId;
                $message->content = $request->input('content');
                $message->save();

                // Редирект или выполнение другой логики
                return redirect()->back()->with('success', 'Message sent successfully');
            } else {
                // Если пользователь не имеет доступа к диалогу, выводим сообщение об ошибке
                return redirect()->back()->with('error', 'You are not authorized to send messages in this conversation');
            }
        } else {
            // Если пользователь не аутентифицирован, выполните соответствующее действие
            // Например, перенаправление на страницу входа или вывод сообщения об ошибке
            return redirect()->route('login')->with('error', 'Please log in to send a message');
        }
    }


    public function showMessage(Response $response)
    {
        // Получаем все сообщения для данного отклика
        $messages = Message::where('response_id', $response->id)->get();

        // Передаем сообщения на страницу сообщений
        return view('messages.show', compact('messages'));
    }


}
