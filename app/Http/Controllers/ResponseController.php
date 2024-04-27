<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Response;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
{
    public function show(Response $responseId): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $user = Auth::user();
        $roleName = $user->role->name;

        if ($roleName == 'employer') {
            $receiver_id = $responseId->announcement->responses->first()->resume->user_id;
        } elseif ($roleName == 'candidate') {
            $receiver_id = $responseId->announcement->creator_id;
        }

        $interlocutor = User::findOrFail($receiver_id);
        $interlocutorName = $interlocutor->name;

        $sender_id = $user->id;
        $messages = $responseId->messages;
        $response_id = $responseId->id;

        return view('show-responses', compact('messages', 'sender_id', 'receiver_id', 'response_id', 'interlocutorName'));
    }

    public function showAll(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $user = Auth::user();
        $announcementId = $request->query('announcement_id');
        $announcement = Announcement::find($announcementId);

        $responses = Response::whereHas('announcement', function($query) use ($user) {
            $query->where('creator_id', $user->id);
        });

        if ($user->resume) {
            $responses->orWhere('resume_id', $user->resume->id);
        }

        $responses = $responses->get();

        return view('responses.showAll', compact('responses', 'announcement'));

    }

}
