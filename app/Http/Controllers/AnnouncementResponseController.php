<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Services\AnnouncementResponseService;
use Illuminate\Http\Request;

class AnnouncementResponseController extends Controller
{
    public function response(Request                     $request,
                             Announcement                $announcement,
                             AnnouncementResponseService $announcementReplyService)
    {
        return $announcementReplyService->responseToAnnouncement($request, $announcement);
    }
}
