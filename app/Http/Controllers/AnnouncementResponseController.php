<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Message;
use App\Models\Response;
use App\Models\User;
use App\Services\RabbitMqService;
use App\Services\YougileApiService;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnnouncementResponseController extends Controller
{
    protected YougileApiService $yougileApiService;

    protected RabbitMqService  $rabbitMqService;

    public function __construct(
        YougileApiService $yougileApiService,
        RabbitMqService $rabbitMqService
    ) {
        $this->yougileApiService = $yougileApiService;
        $this->rabbitMqService = $rabbitMqService;
    }

    public function response(
        Request                     $request,
        Announcement                $announcement,
    ): View|Factory|Application|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $user = auth()->user();
        $employer = User::find($announcement->creator_id);

        try {
            DB::beginTransaction();

            $response = Response::createResponse($announcement, $user);
            Message::sendMessage($user->id, $announcement->creator_id, $response->id, $request->input('message_content'));
            $this->yougileApiService->createNewResponseTask($user, $employer);
            $this->rabbitMqService->sendMessage('response', 'New Response');

            DB::commit();
        } catch (Exception $exception) {
            DB::rollback();
            return redirect()->route('resume')->with('error', 'An error occurred. Please try again.');
        }

        return view('main');
    }
}
