<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Services\AnnouncementResponseService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AnnouncementResponseController extends Controller
{
    public function response(Request                     $request,
                             Announcement                $announcement,
                             AnnouncementResponseService $announcementReplyService): View|Factory|Application|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        return $announcementReplyService->responseToAnnouncement($request, $announcement);
    }
}
