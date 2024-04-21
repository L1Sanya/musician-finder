<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Response;
use App\Models\Skill;
use App\Models\User;
use App\Services\AnnouncementService;
use App\Services\MessageService;
use Illuminate\Http\Request;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AnnouncementController extends Controller
{
    protected $announcementService;

    public function __construct(AnnouncementService $announcementService)
    {
        $this->announcementService = $announcementService;
    }

    public function placeAnnouncementForm()
    {
            $skills = Skill::all();
            return view('place-announcement', compact('skills'));
    }


    public function customAnnouncement(Request $request)
    {
        $this->announcementService->createAnnouncement($request);

        return redirect("/main")->withSuccess('You have created the post');
    }

    public function viewAnnouncements()
    {
        $data = $this->announcementService->getAnnouncements();

        return view('view-announcements', $data);
    }

    public function showAnnouncement(Announcement $announcement)
    {
        return view('show-announcement', compact('announcement'));
    }


    public function filter(Request $request)
    {
        $data = $this->announcementService->filterAnnouncements($request);

        return view('view-announcements', $data);
    }

    public function search(Request $request)
    {
        $data = $this->announcementService->searchAnnouncements($request);

        return view('search-results', $data);
    }
}
