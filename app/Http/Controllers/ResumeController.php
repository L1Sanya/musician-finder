<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Resume;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResumeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $skills = Skill::all();
            return view('custom-resume-form', compact('skills'));
        } else
            return redirect('/login')->withSuccess("Please login");

    }

    public function customResume(Request $request)
    {
        if (Auth::check()) {
            $resume = new Resume();
            $resume->experience = $request->input('experience');
            $resume->info = $request->input('info');
            $resume->user_id = auth()->id();
            $resume->save();

            $resume->skills()->attach($request->input('skills'));

            return redirect("/main")->withSuccess('You have created the post');

        } else
            return redirect("/login")->withSuccess('please login');
    }

    public function showResume()
    {
        if (Auth::check()) {
            $resume = Resume::where('user_id', auth()->id())->first();
            if ($resume) {
                return view('resume', compact('resume'));
            } else {
                return redirect()->back()->withError("Resume not found.");
            }
        } else {
            return redirect('/login')->withError("Please login.");
        }
    }
}
