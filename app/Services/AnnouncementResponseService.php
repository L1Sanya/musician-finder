<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class AnnouncementResponseService
{
    protected ResponseService $responseService;
    protected MessageService $messageService;
    protected EmailService $emailService;
    protected YougileApiService $yougileApiService;

    protected RabbitMqService  $rabbitMqService;

    public function __construct(
        ResponseService $responseService,
        MessageService $messageService,
        EmailService $emailService,
        YougileApiService $yougileApiService,
        RabbitMqService $rabbitMqService
    ) {
        $this->responseService = $responseService;
        $this->messageService = $messageService;
        $this->emailService = $emailService;
        $this->yougileApiService = $yougileApiService;
        $this->rabbitMqService = $rabbitMqService;
    }

    public function responseToAnnouncement($request, $announcement): Application|View|Factory|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        $user = auth()->user();
        $employer = User::find($announcement->creator_id);

        try {
            DB::beginTransaction();

            $response = $this->responseService->createResponse($announcement, $user);
            $this->messageService->sendMessage($user->id, $announcement->creator_id, $response->id, $request->input('message_content'));
            $this->emailService->sendEmailNotification($announcement, $user);
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
