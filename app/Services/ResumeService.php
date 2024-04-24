<?php

namespace App\Services;

use App\Models\Resume;
use Exception;

class ResumeService
{
    public function createOrUpdateResume($userId, $requestData): Resume
    {
        $resume = Resume::where('user_id', $userId)->first();

        if ($resume) {
            $this->deleteResume($resume);
        }

        return $this->createResume($userId, $requestData);
    }

    protected function createResume($userId, $requestData): Resume
    {
        $resume = new Resume();
        $resume->user_id = $userId;
        $resume->experience = $requestData->input('experience');
        $resume->info = $requestData->input('info');
        $resume->save();

        $resume->skills()->attach($requestData->input('skills'));

        return $resume;
    }

    protected function deleteResume($resume): void
    {
        $resume->skills()->detach();
        $resume->delete();
    }

    public function getUserResume($userId)
    {
        return Resume::where('user_id', $userId)->first();
    }

    /**
     * @throws Exception
     */
    public function updateResume($resumeId, $requestData)
    {
        $resume = Resume::findOrFail($resumeId);

        if ($resume->user_id != auth()->id()) {
            throw new Exception("You don't have permission to edit this resume.");
        }

        $resume->update([
            'experience' => $requestData->input('experience'),
            'info' => $requestData->input('info'),
        ]);

        $resume->skills()->sync($requestData->input('skills'));

        return $resume;
    }
}
