<?php

namespace App\Services;

use App\Models\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


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
            $receiver_id = $response->announcement->responses->first()->resume->user_id;
        } elseif ($roleName == 'candidate') {
            $receiver_id = $response->announcement->creator_id;
        }

        $interlocutor = User::findOrFail($receiver_id);
        $interlocutorName = $interlocutor->name;

        $sender_id = $user->id;
        $messages = $response->messages;
        $response_id = $response->id;

        return compact('response', 'messages', 'sender_id', 'receiver_id', 'response_id', 'interlocutorName');
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
