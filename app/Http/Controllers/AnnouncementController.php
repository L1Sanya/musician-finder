<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function placeAnnouncementForm()
    {
        if (Auth::check()) {
            $skills = Skill::all();
            return view('place-announcement', compact('skills'));
        } else
            return redirect('/login')->withSuccess("Please login");
    }



    public function customAnnouncement(Request $request)
    {
        $announcement = new Announcement();
        $announcement->title = $request->input('title');
        $announcement->description = $request->input('description');
        $announcement->location = $request->input('location');
        $announcement->creator_id = auth()->id();
        $announcement->save();

        $announcement->skills()->attach($request->input('skills'));

        return redirect("/main")->withSuccess('You have created the post');
    }

    public function viewAnnouncements()
    {
        $announcements = Announcement::all();
        return view('view-announcements', compact('announcements'));
    }


}
