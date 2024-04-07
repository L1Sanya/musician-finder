<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Response;
use App\Models\Skill;
use App\Models\User;
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

    public function showAnnouncement(Announcement $announcement)
    {
        return view('show-announcement', compact('announcement'));
    }

    public function reply(Request $request, Announcement $announcement)
    {
        $messages = Message::all();

        if (Auth::check()) {
            $user = auth()->user();

            if ($user->resume) {

                $response = new Response();
                $response->announcement_id = $announcement->id;
                $response->resume_id = $user->resume->id;
                $response->save();

                $messageContent = $request->input('message_content');
                $messageFromSender = new Message();
                $messageFromSender->sender_id = $user->getAuthIdentifier();
                $messageFromSender->receiver_id = $announcement->creator_id;
                $messageFromSender->response_id = $response->id;
                $messageFromSender->content = $messageContent;
                $messageFromSender->save();

                return view('show-responses', compact('messages'));
            } else {

                return redirect()->route('resume.create')->with('error', 'Please create your resume first');
            }
        }

        return redirect()->route('main')->with('error', 'Please login to reply');
    }



}
