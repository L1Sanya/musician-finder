<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Message;
use App\Models\Response;
use App\Models\User;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
{
    protected $responseService;

    public function __construct(ResponseService $responseService)
    {
        $this->responseService = $responseService;
    }

    public function show(Response $response)
    {
        $data = $this->responseService->prepareResponseData($response);

        return view('show-responses', $data);
    }

    public function showAllResponses(Request $request)
    {
        $user = auth()->user();
        $announcementId = $request->query('announcement_id');
        $announcement = Announcement::find($announcementId);
        $responses = $this->responseService->getUserResponses($user);

        return view('responses.showAll', compact('responses', 'announcement'));
    }

}
