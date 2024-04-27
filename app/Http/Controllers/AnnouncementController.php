<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AnnouncementController extends Controller
{
    public function createForm(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
            $skills = Skill::all();
            return view('place-announcement', compact('skills'));
    }


    public function create(Request $request)
    {
        $announcement = Announcement::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'location' => $request->input('location'),
            'creator_id' => auth()->id(),
        ]);

        $announcement->skills()->attach($request->input('skills'));

        return redirect("/main")->withSuccess('You have created the post');
    }

    public function get(Request $request): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        if ($request->filled('query')) {
            $data = $this->searchAnnouncements($request);
        } elseif ($request->filled('skill') || $request->filled('location')) {
            $data = $this->filterAnnouncements($request);
        } else {
            $data = $this->getAnnouncements();
        }

        return view('announcements', $data);
    }


    public function show(Announcement $announcementId): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('show-announcement', compact('announcementId'));
    }

    public function getAnnouncements(): array
    {
        $user = Auth::user();
        $announcements = Announcement::query();
        $skills = Skill::all();
        $locations = Announcement::distinct()->pluck('location');

        if ($user->role->name == 'candidate' && $user->resume) {
            $resumeSkills = $user->resume->skills->pluck('id')->toArray();
            $resumeLocation = $user->resume->location;

            $announcements->where(function ($query) use ($resumeSkills, $resumeLocation) {
                $query->whereHas('skills', function ($query) use ($resumeSkills) {
                    $query->whereIn('skills.id', $resumeSkills);
                })->orWhere('location', $resumeLocation);
            });
        }

        $announcements = $announcements->get();

        return compact('announcements', 'skills', 'locations');
    }

    public function searchAnnouncements($requestData): array
    {
        $query = $requestData->input('query');

        $announcementsByTitle = $this->searchByTitle($query);
        $announcementsBySkills = $this->searchBySkills($query);
        $announcementsByLocation = $this->searchByLocation($query);

        $announcements = $announcementsByTitle->merge($announcementsBySkills)->merge($announcementsByLocation);

        return compact('announcements');
    }

    public function filterAnnouncements($requestData): array
    {
        $skills = Skill::all();
        $locations = Announcement::distinct()->pluck('location')->toArray();

        $selectedSkill = $requestData->input('skill');
        $selectedLocation = $requestData->input('location');

        $query = Announcement::query();

        if ($selectedSkill) {
            $query->whereHas('skills', function ($q) use ($selectedSkill) {
                $q->where('skills.id', $selectedSkill);
            });
        }

        if ($selectedLocation) {
            $query->where('location', $selectedLocation);
        }

        $announcements = $query->get();

        return compact('announcements', 'skills', 'locations');
    }

    protected function searchByTitle($query)
    {
        return Announcement::where('title', 'like', '%' . $query . '%')->get();
    }

    protected function searchBySkills($query)
    {
        $skills = Skill::where('name', 'like', '%' . $query . '%')->pluck('id');
        return Announcement::whereHas('skills', function ($query) use ($skills) {
            $query->whereIn('skills.id', $skills);
        })->get();
    }

    protected function searchByLocation($query)
    {
        return Announcement::where('location', 'like', '%' . $query . '%')->get();
    }
}
