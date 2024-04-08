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
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role->name == 'employer') {
                $receiver_id = $response->announcement->responses->first()->resume->user_id;
            } elseif ($user->role->name == 'candidate') {
                $receiver_id = $response->announcement->creator_id;
            }

            $sender_id = $user->id;
            $messages = $response->messages;
            $response_id = $response->id; // Добавляем получение $response_id

            return view('show-responses', compact('response', 'messages', 'sender_id', 'receiver_id', 'response_id')); // Включаем $response_id в компакт
        } else {
            return redirect()->back()->with('error', 'You are not authorized to view this conversation');
        }
    }

    public function showAllResponses(Request $request)
    {
        $user = Auth::user();

        // Проверяем, что пользователь залогинен
        if ($user) {
            // Получаем ответы, связанные с объявлениями пользователя или его резюме
            $responses = Response::whereHas('announcement', function($query) use ($user) {
                $query->where('creator_id', $user->id);
            });

            // Проверяем, существует ли у пользователя резюме
            if ($user->resume) {
                // Если резюме существует, добавляем условие для ответов, связанных с резюме пользователя
                $responses->orWhere('resume_id', $user->resume->id);
            }

            // Получаем результаты запроса
            $responses = $responses->get();

            // Передаем ответы в представление для отображения
            return view('responses.showAll', compact('responses'));
        } else {
            // Если пользователь не залогинен, перенаправляем на страницу логина
            return redirect()->route('login');
        }
    }

}
