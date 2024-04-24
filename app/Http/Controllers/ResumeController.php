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
    protected ResumeService $resumeService;

    public function __construct(ResumeService $resumeService)
    {
        $this->resumeService = $resumeService;
    }

    public function index(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
            $skills = Skill::all();
            return view('custom-resume-form', compact('skills'));
    }

    public function customResume(Request $request): Application|Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        $userId = auth()->id();
        $this->resumeService->createOrUpdateResume($userId, $request);

        return redirect("/main")->with('success', 'You have created the post');
    }

    public function showResume(): View|Factory|Application|Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        $resume = $this->resumeService->getUserResume(auth()->id());

        if ($resume) {
            return view('resume', compact('resume'));
        } else {
            return redirect("resume")->withErrors("Resume not found.");
        }
    }

    public function showResumeForEmployer($resumeId): View|Application|Factory|\Illuminate\Contracts\Foundation\Application|RedirectResponse
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
            $resume = $this->resumeService->updateResume($resumeId, $request);

            return redirect()->route('resume.show', $resume->id)->with('success', 'Resume updated successfully.');
        } catch (Exception $e) {
            return redirect()->route('resume.show')->withErrors($e->getMessage());
        }
    }

}
