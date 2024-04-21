<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class AnnouncementResponseService
{
    protected $responseService;
    protected $messageService;
    protected $emailService;

    public function __construct(
        ResponseService $responseService,
        MessageService $messageService,
        EmailService $emailService
    ) {
        $this->responseService = $responseService;
        $this->messageService = $messageService;
        $this->emailService = $emailService;
    }

    public function responseToAnnouncement($request, $announcement)
    {
        $user = auth()->user();

        if (!$user->resume) {
            return redirect()->route('resume')->with('error', 'Please create your resume first');
        }

        try {
            DB::beginTransaction();

            $response = $this->responseService->createResponse($announcement, $user);
            $this->messageService->sendMessage($user->id, $announcement->creator_id, $response->id, $request->input('message_content'));
            $this->emailService->sendEmailNotification($announcement, $user);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('resume')->with('error', 'An error occurred. Please try again.');
        }

        return view('main');
    }
}
