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

    public function showAllResponses(Request $request)
    {
        $messages = Message::all();
        $responses = Response::all();
        return view('responses.showAll', compact('responses', 'messages'));
    }


    public function create(Request $request, Announcement $announcement)
    {
        if (Auth::check()) {
            $user = auth()->user();

            if ($user->isCandidate()) {
                // Создаем новый отклик
                $response = new Response();
                $response->announcement_id = $announcement->id;
                $response->resume_id = $user->resume->id;
                $response->save();

                return redirect()->route('responses.show', $response)->with('success', 'Response created successfully');
            } else {
                // Если пользователь не кандидат, выводим сообщение об ошибке
                return redirect()->back()->with('error', 'Only candidates can respond to announcements');
            }
        } else {
            return redirect()->route('login')->with('error', 'Please log in to respond to announcements');
        }
    }

    public function reject(Request $request)
    {

        if (Auth::check()) {

            $responseId = $request->input('response_id');
            $response = Response::find($responseId);


            if ($response) {
                $message = new Message();
                $message->sender_id = auth()->id();
                $message->receiver_id = $response->resume->user_id; // Отправляем сообщение автору резюме, на которое откликнулись
                $message->response_id = $responseId;
                $message->content = 'Your application has been rejected.';
                $message->save();

                $response->delete();

                return redirect()->back()->with('success', 'Response rejected successfully');
            } else {
                return redirect()->back()->with('error', 'Response not found');
            }
        } else {
            return redirect()->route('login')->with('error', 'Please login to reject responses');
        }
    }


}
