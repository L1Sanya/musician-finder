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

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'announcement_skill');
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
