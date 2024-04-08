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

    }


    public function showMessage(Response $response)
    {
        $messages = Message::where('response_id', $response->id)->get();

        return view('messages.show', compact('messages'));
    }

    public function getByResponseId(Request $request)
    {
        $responseId = $request->input('response_id');

        $messages = Message::where('response_id', $responseId)->get();

        return response()->json($messages);
    }

}
