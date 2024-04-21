<?php

namespace App\Services;

use App\Models\Announcement;
use App\Models\Skill;
use Illuminate\Support\Facades\Auth;

class AnnouncementService
{
    public function createAnnouncement($requestData)
    {
        $announcement = new Announcement();
        $announcement->title = $requestData->input('title');
        $announcement->description = $requestData->input('description');
        $announcement->location = $requestData->input('location');
        $announcement->creator_id = auth()->id();
        $announcement->save();

        $announcement->skills()->attach($requestData->input('skills'));

        return $announcement;
    }

    public function getAnnouncements()
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
            $announcements = $announcements->get();

            return compact('announcements', 'skills', 'locations');
        }

        $announcements = $announcements->get();

        return compact('announcements', 'skills', 'locations');
    }

    public function filterAnnouncements($requestData)
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

    public function searchAnnouncements($requestData)
    {
        $query = $requestData->input('query');

        $announcementsByTitle = Announcement::where('title', 'like', '%' . $query . '%')->get();

        $skills = Skill::where('name', 'like', '%' . $query . '%')->pluck('id');
        $announcementsBySkills = Announcement::whereHas('skills', function ($query) use ($skills) {
            $query->whereIn('skills.id', $skills);
        })->get();

        $announcementsByLocation = Announcement::where('location', 'like', '%' . $query . '%')->get();

        $announcements = $announcementsByTitle->merge($announcementsBySkills)->merge($announcementsByLocation);

        return compact('announcements');
    }
}
