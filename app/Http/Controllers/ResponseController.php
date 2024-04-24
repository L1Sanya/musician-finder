<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Response;
use App\Services\ResponseService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    protected ResponseService $responseService;

    public function __construct(ResponseService $responseService)
    {
        $this->responseService = $responseService;
    }

    public function show(Response $response): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $data = $this->responseService->prepareResponseData($response);

        return view('show-responses', $data);
    }

    public function showAllResponses(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $user = auth()->user();
        $announcementId = $request->query('announcement_id');
        $announcement = Announcement::find($announcementId);
        $responses = $this->responseService->getUserResponses($user);

        return view('responses.showAll', compact('responses', 'announcement'));
    }

}
