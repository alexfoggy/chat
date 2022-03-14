<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'email_verified_at', 'main_language', 'main_language_level',
        'country', 'password', 'token', 'avatar', 'current_location', 'phone', 'birth_date', 'gender', 'paypal', 'voice',
        'remember_token'];
}
