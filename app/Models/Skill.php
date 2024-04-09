<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $hidden = [
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function resumes()
    {
        return $this->belongsToMany(Resume::class, 'resume_skills');
    }

    public function announcements()
    {
        return $this->belongsToMany(Announcement::class, 'announcement_skill');
    }
}
