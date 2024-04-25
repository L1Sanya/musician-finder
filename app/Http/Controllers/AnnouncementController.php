<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Services\AnnouncementService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use App\Models\Announcement;


class AnnouncementController extends Controller
{
    protected AnnouncementService $announcementService;

    public function __construct(AnnouncementService $announcementService)
    {
        $this->announcementService = $announcementService;
    }

    public function placeAnnouncementForm(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
            $skills = Skill::all();
            return view('place-announcement', compact('skills'));
    }


    public function customAnnouncement(Request $request)
    {
        $this->announcementService->createAnnouncement($request);

        return redirect("/main")->withSuccess('You have created the post');
    }

    public function viewAnnouncements(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $data = $this->announcementService->getAnnouncements();

        return view('view-announcements', $data);
    }

    public function showAnnouncement(Announcement $announcement): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('show-announcement', compact('announcement'));
    }


    public function filter(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $data = $this->announcementService->filterAnnouncements($request);

        return view('view-announcements', $data);
    }

    public function search(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $data = $this->announcementService->searchAnnouncements($request);

        return view('search-results', $data);
    }
}
