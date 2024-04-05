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

        // Проверяем, аутентифицирован ли пользователь
        if (Auth::check()) {
            $user = auth()->user();

            // Проверяем, существует ли у пользователя резюме, прежде чем использовать его идентификатор
            if ($user->resume) {
                // Создаем новый отклик
                $response = new Response();
                $response->announcement_id = $announcement->id;
                $response->resume_id = $user->resume->id;
                $response->save();

                // Создаем новое сообщение
                $messageContent = $request->input('message_content');
                $messageFromSender = new Message();
                $messageFromSender->sender_id = $user->getAuthIdentifier();
                $messageFromSender->receiver_id = $announcement->creator_id;
                $messageFromSender->response_id = $response->id;
                $messageFromSender->content = $messageContent;
                $messageFromSender->save();

                // Возвращаем представление с сообщениями
                return view('show-responses', compact('messages'));
            } else {
                // Если у пользователя нет резюме, можно сделать соответствующее действие
                // Например, вы можете перенаправить пользователя на страницу создания резюме
                return redirect()->route('resume.create')->with('error', 'Please create your resume first');
            }
        }

        // Если пользователь не аутентифицирован, перенаправляем его на главную страницу
        return redirect()->route('main')->with('error', 'Please login to reply');
    }



}
