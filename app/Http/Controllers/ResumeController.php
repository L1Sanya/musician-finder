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
            $user_id = auth()->id();
            $resume = Resume::where('user_id', $user_id)->first();

            if ($resume) {
                $resume->skills()->detach();
                $resume->delete();
            }

            $resume = new Resume();
            $resume->user_id = $user_id;
            $resume->experience = $request->input('experience');
            $resume->info = $request->input('info');
            $resume->save();

            $resume->skills()->attach($request->input('skills'));

            return redirect("/main")->with('You have created the post');

        } else
            return redirect("/login")->with('please login');
    }

    public function showResume()
    {
        if (Auth::check()) {
            $resume = Resume::where('user_id', auth()->id())->first();
            if ($resume) {
                return view('resume', compact('resume'));
            } else {
                return redirect("resume")->withErrors("Resume not found.");
            }
        } else {
            return redirect('/login')->withErrors("Please login.");
        }
    }

    public function showResumeForEmployer($resumeId)
    {
        if (Auth::check()) {
            $resume = Resume::findOrFail($resumeId);
            if ($resume) {
                return view('ShowResumeForEmployer', compact('resume'));
            } else {
                return redirect()->route('resume.index')->withErrors("Resume not found.");
            }
        } else {
            return redirect('/login')->withErrors("Please login.");
        }
    }

    public function deleteResume()
    {
        if (Auth::check()) {
            $user_id = auth()->id();
            $resume = Resume::where('user_id', $user_id)->first();
            if ($resume) {
                $resume->skills()->detach();

                $resume->delete();

                return redirect("/main")->with('You have deleted the resume');
            } else {
                return redirect()->back()->withErrors("Resume not found.");
            }
        } else {
            return redirect('/login')->withErrors("Please login.");
        }
    }
}
