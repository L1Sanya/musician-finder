<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Resume extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'experience',
        'info'
    ];

    protected $hidden = [
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'resume_skills', 'resume_id', 'skill_id');
    }

}
