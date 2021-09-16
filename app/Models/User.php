<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const IMG_URL = "storage/user/";
    const IMG_PATH = "app/public/user/";

    protected $fillable = ['first_name', 'last_name', 'email', 'password',
        'mobile_number', 'company_name', 'company_website', 'country', 'bio',
        'twitter_link', 'facebook_link', 'linkedin_link', 'youtube_link', 'image',
        'activation_key', 'email_verified_at', 'status', 'remember_token'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
