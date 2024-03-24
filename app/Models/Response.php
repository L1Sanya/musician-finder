<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Response extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'announcement_id',
        'resume_id',
    ];

    protected $hidden = [
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function announcement()
    {
        return $this->belongsTo(Announcement::class);
    }

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
