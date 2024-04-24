<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;



class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public function resume(): HasOne
    {
        return $this->hasOne(Resume::class); // Один пользователь имеет одно резюме
    }

    public function sender(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id'); // Пользователь отправляет много сообщений
    }

    public function receiver(): HasMany
    {
        return $this->hasMany(Message::class, 'receiver_id'); // Пользователь получает много сообщений
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function isCandidate(): bool
    {
        return $this->role->name === 'candidate';
    }

    public function isEmployer(): bool
    {
        return $this->role->name === 'employer';
    }
}
