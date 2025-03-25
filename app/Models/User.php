<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// Import the Passport trait
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    // Enable Passport API tokens along with notifications
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     * Added 'username' for our custom login field.
     *
     * @var array
     */
    protected $fillable = [
        'name',       // User's full name
        'username',   // Unique username for login
        'password',   // User's password (hashed)
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',   // Hide password from JSON responses
        'remember_token',
    ];
}
