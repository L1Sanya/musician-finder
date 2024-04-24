<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function announcement(): BelongsTo
    {
        return $this->belongsTo(Announcement::class); // Отклик относится к одному объявлению
    }

    public function resume(): BelongsTo
    {
        return $this->belongsTo(Resume::class); // Отклик относится к одному резюме
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
