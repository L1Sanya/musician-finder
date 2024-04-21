<?php

namespace App\Services;

use App\Models\Resume;

class ResumeService
{
    public function createOrUpdateResume($userId, $requestData)
    {
        $resume = Resume::where('user_id', $userId)->first();

        if ($resume) {
            $this->deleteResume($resume);
        }

        $resume = $this->createResume($userId, $requestData);

        return $resume;
    }

    protected function createResume($userId, $requestData)
    {
        $resume = new Resume();
        $resume->user_id = $userId;
        $resume->experience = $requestData->input('experience');
        $resume->info = $requestData->input('info');
        $resume->save();

        $resume->skills()->attach($requestData->input('skills'));

        return $resume;
    }

    protected function deleteResume($resume)
    {
        $resume->skills()->detach();
        $resume->delete();
    }

    public function getUserResume($userId)
    {
        return Resume::where('user_id', $userId)->first();
    }

    public function updateResume($resumeId, $requestData)
    {
        $resume = Resume::findOrFail($resumeId);

        if ($resume->user_id != auth()->id()) {
            throw new \Exception("You don't have permission to edit this resume.");
        }

        $resume->update([
            'experience' => $requestData->input('experience'),
            'info' => $requestData->input('info'),
        ]);

        $resume->skills()->sync($requestData->input('skills'));

        return $resume;
    }
}
