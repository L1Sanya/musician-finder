<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Message;
use App\Models\Response;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function check($id)
    {
        $response = Response::All($id);
        return view('responses.show', compact('response'));
    }
}
