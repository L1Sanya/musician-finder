<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Response;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AnnouncementController extends Controller
{
    public function placeAnnouncementForm()
    {
            $skills = Skill::all();
            return view('place-announcement', compact('skills'));
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

        $skills = Skill::all();
        $announcements = Announcement::query();
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

        return view('view-announcements', compact('announcements', 'skills', 'locations'));
    }

    public function showAnnouncement(Announcement $announcement)
    {
        return view('show-announcement', compact('announcement'));
    }

    public function reply(Request $request, Announcement $announcement)
    {
        $user = auth()->user();

        if ($user->resume) {

            $response = new Response();
            $response->announcement_id = $announcement->id;
            $response->resume_id = $user->resume->id;
            $response->save();

            $messageContent = $request->input('message_content');
            $messageFromSender = new Message();
            $messageFromSender->sender_id = $user->id; // Отправитель - текущий пользователь
            $messageFromSender->receiver_id = $announcement->creator_id; // Получатель
            $messageFromSender->response_id = $response->id;
            $messageFromSender->content = $messageContent;
            $messageFromSender->save();

            $receiverEmail = User::find($announcement->creator_id)->email;
            $receiverName = User::find($announcement->creator_id)->name;
            $data = array('name' => $receiverEmail); // Передаем email в шаблон
            Mail::send(['text' => 'mail'], $data, function($message) use ($receiverEmail, $user, $receiverName) {
                $message->to($receiverEmail,$receiverName)->subject('Hello');
                $message->from($user->email, $user->name); // Отправитель
            });

            return view('main');
        } else {
            return redirect()->route('resume')->with('error', 'Please create your resume first');
        }
    }

    public function filter(Request $request)
    {
        $skills = Skill::all();
        $locations = Announcement::distinct()->pluck('location')->toArray();

        $selectedSkill = $request->input('skill');
        $selectedLocation = $request->input('location');

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

        return view('view-announcements', compact('announcements', 'skills', 'locations'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $announcementsByTitle = Announcement::where('title', 'like', '%' . $query . '%')->get();

        $skills = Skill::where('name', 'like', '%' . $query . '%')->pluck('id');
        $announcementsBySkills = Announcement::whereHas('skills', function ($query) use ($skills) {
            $query->whereIn('skills.id', $skills);
        })->get();

        $announcementsByLocation = Announcement::where('location', 'like', '%' . $query . '%')->get();

        $announcements = $announcementsByTitle->merge($announcementsBySkills)->merge($announcementsByLocation);

        return view('search-results', compact('announcements'));
    }
}
