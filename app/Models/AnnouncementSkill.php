<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncementSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'announcement_id',
        'skill_id'
    ];

    protected $hidden = [
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
