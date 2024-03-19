<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Announcement extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'title',
        'description',
        'creator_id',
        'location'
    ];

    protected $hidden = [
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }
}
