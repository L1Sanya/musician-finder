<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Message;
use App\Models\Response;
use App\Models\User;
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
                $interlocutorId = $receiver_id;
                $interlocutor = User::findOrFail($interlocutorId);
                $interlocutorName = $interlocutor->name;
            } elseif ($user->role->name == 'candidate') {
                $receiver_id = $response->announcement->creator_id;
                $interlocutorId = $receiver_id;
                $interlocutor = User::findOrFail($interlocutorId);
                $interlocutorName = $interlocutor->name;
            }

            $sender_id = $user->id;
            $messages = $response->messages;
            $response_id = $response->id;


            return view('show-responses', compact('response', 'messages', 'sender_id', 'receiver_id', 'response_id', 'interlocutorName')); // Включаем $response_id в компакт
        } else {
            return redirect()->back()->with('error', 'You are not authorized to view this conversation');
        }
    }

    public function showAllResponses(Request $request, )
    {
        $user = Auth::user();
        $announcementId = $request->query('announcement_id');
        $announcement = Announcement::find($announcementId);

        if ($user) {
            $responses = Response::whereHas('announcement', function($query) use ($user) {
                $query->where('creator_id', $user->id);
            });

            if ($user->resume) {
                $responses->orWhere('resume_id', $user->resume->id);
            }

            $responses = $responses->get();

            return view('responses.showAll', compact('responses', 'announcement'));
        } else {

            return redirect()->route('login');
        }
    }


    public function reject(Request $request, $responseId)
    {

    }

}
