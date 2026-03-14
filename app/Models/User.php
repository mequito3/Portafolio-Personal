<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'job_title',
        'bio',
        'location',
        'phone',
        'avatar',
        'logo',
        'logo_dark',
        'favicon',
        'github_url',
        'linkedin_url',
        'twitter_url',
        'stack_backend',
        'stack_frontend',
        'stack_database',
        'stack_devops',
        'years_experience',
        'clients_count',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_admin' => 'boolean',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }
}
