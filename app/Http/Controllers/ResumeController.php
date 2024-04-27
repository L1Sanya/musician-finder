<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Models\Skill;
use App\Services\ResumeService;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class ResumeController extends Controller
{

    public function createForm(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
            $skills = Skill::all();
            return view('create-resume-form', compact('skills'));
    }

    public function createOrUpdate(Request $request): Application|Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        $userId = auth()->id();
        $resume = Resume::where('user_id', $userId)->first();

        if ($resume) {
            $this->deleteResume($resume);
        }

        $resume = Resume::create([
            'user_id' => $userId,
            'experience' => $request->input('experience'),
            'info' => $request->input('info'),
        ]);

        $resume->skills()->attach($request->input('skills'));

        return redirect("/my-resume")->with('success', 'You have created the post');
    }

    public function show(): View|Factory|Application|Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        $resume = Resume::where('user_id', auth()->id())->first();

        if ($resume) {
            return view('resume', compact('resume'));
        } else {
            return redirect("resume")->withErrors("Resume not found.");
        }
    }

    public function showForEmployer($resumeId): View|Application|Factory|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
            $resume = Resume::findOrFail($resumeId);

            if ($resume) {
                return view('ShowResumeForEmployer', compact('resume'));
            } else {
                return redirect()->route('resume.index')->withErrors("Resume not found.");
            }
    }

    public function deleteResume(): Application|Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
            $user_id = auth()->id();
            $resume = Resume::where('user_id', $user_id)->first();
            if ($resume) {
                $resume->skills()->detach();
                $resume->delete();

                return redirect("/main")->with('You have deleted the resume');
            } else {
                return redirect()->back()->withErrors("Resume not found.");
            }
    }

    public function edit(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $skills = Skill::all();
        $resume = Resume::where('user_id', auth()->id())->first();
        return view('edit-resume', compact('resume', 'skills'));
    }

    public function update(Request $request, $resumeId): RedirectResponse
    {
        $request->validate([
            'experience' => 'required|string',
            'info' => 'nullable|string',
            'skills' => 'nullable|array',
        ]);

        try {
            $resume = Resume::findOrFail($resumeId);

            if ($resume->user_id != auth()->id()) {
                throw new Exception("You don't have permission to edit this resume.");
            }

            $resume->update([
                'experience' => $request->input('experience'),
                'info' => $request->input('info'),
            ]);

            $resume->skills()->sync($request->input('skills'));

            return redirect()->route('resume.show', $resume->id)->with('success', 'Resume updated successfully.');
        } catch (Exception $e) {
            return redirect()->route('resume.show')->withErrors($e->getMessage());
        }
    }

}
