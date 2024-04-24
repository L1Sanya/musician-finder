<?php

namespace App\Services;

use App\Models\Announcement;
use App\Models\Skill;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class AnnouncementService
{
    public function createAnnouncement($requestData): Announcement
    {
        $announcement = Announcement::create([
            'title' => $requestData->input('title'),
            'description' => $requestData->input('description'),
            'location' => $requestData->input('location'),
            'creator_id' => auth()->id(),
        ]);

        $announcement->skills()->attach($requestData->input('skills'));

        return $announcement;
    }

    public function getAnnouncements(): array
    {
        $announcements = Announcement::query();
        $skills = Skill::all();
        $locations = Announcement::distinct()->pluck('location');

        if (Auth::user()->role->name == 'candidate' && Auth::user()->resume) {
            $resumeSkills = Auth::user()->resume->skills->pluck('id')->toArray();
            $resumeLocation = Auth::user()->resume->location;

            $announcements->where(function ($query) use ($resumeSkills, $resumeLocation) {
                $query->whereHas('skills', function ($query) use ($resumeSkills) {
                    $query->whereIn('skills.id', $resumeSkills);
                })->orWhere('location', $resumeLocation);
            });
        }

        $announcements = $announcements->get();

        return compact('announcements', 'skills', 'locations');
    }

    public function filterAnnouncements($selectedSkillId, $selectedLocation): array
    {
        $skills = Skill::all();
        $locations = Announcement::distinct()->pluck('location')->toArray();

        $announcementsBySkills = $this->filterBySkills($selectedSkillId);
        $announcementsByLocation = $this->filterByLocation($selectedLocation);

        $announcements = $announcementsBySkills->merge($announcementsByLocation);

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


    public function filterBySkills($selectedSkillId): Collection
    {
        return Announcement::whereHas('skills', function ($q) use ($selectedSkillId) {
            $q->where('skills.id', $selectedSkillId);
        })->get();
    }

    public function filterByLocation($selectedLocation): Collection
    {
        return Announcement::where('location', $selectedLocation)->get();
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
