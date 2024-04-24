<?php

namespace App\Services;

use App\Models\Announcement;
use App\Models\Message;
use App\Models\Response;
use App\Models\User;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ResponseService
{
    public function createResponse($announcement, $user): Response
    {
        return Response::create([
            'announcement_id' => $announcement->id,
            'resume_id' => $user->resume->id,
        ]);
    }

    public function prepareResponseData($response): array
    {
        $user = Auth::user();
        $roleName = $user->role->name;

        if ($roleName == 'employer') {
            $receiverId = $response->announcement->responses->first()->resume->user_id;
        } elseif ($roleName == 'candidate') {
            $receiverId = $response->announcement->creator_id;
        }

        $interlocutor = User::findOrFail($receiverId);
        $interlocutorName = $interlocutor->name;

        $senderId = $user->id;
        $messages = $response->messages;
        $responseId = $response->id;

        return compact('response', 'messages', 'senderId', 'receiverId', 'responseId', 'interlocutorName');
    }

    public function getUserResponses($user)
    {
        $responses = Response::whereHas('announcement', function ($query) use ($user) {
            $query->where('creator_id', $user->id);
        });

        if ($user->resume) {
            $responses->orWhere('resume_id', $user->resume->id);
        }

        return $responses->get();
    }
}
