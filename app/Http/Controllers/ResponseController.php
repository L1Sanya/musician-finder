<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Message;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
{
    public function show(Response $response)
    {
        if (Auth::check() && (Auth::user()->id == $response->announcement->creator_id || Auth::user()->id == $response->resume->user_id)) {
            $messages = $response->messages()->get();
            return view('show-responses', compact('response', 'messages'));
        } else {
            return redirect()->back()->with('error', 'You are not authorized to view this conversation');
        }
    }

    public function index()
    {
        $messages = Message::all();
        $responses = Response::all();
        return view('index', compact('responses', 'messages'));
    }

    public function reject(Request $request)
    {

        if (Auth::check()) {

            $responseId = $request->input('response_id');
            $response = Response::find($responseId);


            if ($response) {
                // Отправляем сообщение об отклонении отклика
                $message = new Message();
                $message->sender_id = auth()->id();
                $message->receiver_id = $response->resume->user_id; // Отправляем сообщение автору резюме, на которое откликнулись
                $message->response_id = $responseId;
                $message->content = 'Your application has been rejected.';
                $message->save();

                // Удаляем отклик из базы данных
                $response->delete();

                // Возвращаем сообщение об успешном отклонении отклика
                return redirect()->back()->with('success', 'Response rejected successfully');
            } else {
                // Если отклик не найден, возвращаем ошибку
                return redirect()->back()->with('error', 'Response not found');
            }
        } else {
            // Если пользователь не аутентифицирован, перенаправляем его на страницу входа
            return redirect()->route('login')->with('error', 'Please login to reject responses');
        }
    }


}
