<?php

namespace App;

use App\Models\Language;
use App\Models\Sites;
use App\Models\UserType;
use App\Models\Country;
use App\Models\Project;
use App\Notifications\EmailVerificationNotification;
use App\Notifications\ResetPasswordNotification;
use App\Traits\FileTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Ramsey\Uuid\Uuid;

class UserSite extends Model
{
    protected $table = 'users_site';

    protected $fillable = [
        'key',
    ];

}
