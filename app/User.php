<?php

namespace App;

use App\Models\Language;
use App\Models\Task;
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

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use FileTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name','email_verified_at', 'email', 'password', 'token', 'avatar', 'country', 'current_location', 'phone', 'birth_date', 'gender', 'paypal', 'main_language_level', 'voice','dialect_status','facebook_id','google_id','type'
    ];

//    protected $primaryKey = 'token';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new EmailVerificationNotification());
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function tasks()
    {
        return $this->morphToMany(Task::class,'taskable', 'taskables', 'taskable_id','task_uuid','id', 'uuid');
    }

    public function tasksList()
    {
        return $this->hasMany(Task::class,'user_id', 'id');
    }

    public function languages()
    {
        return $this->morphToMany(Language::class,'languageable', 'languageables')->withPivot([
            'dialect', 'level'
        ]);
    }

    public function mainUserLanguage()
    {
        return $this->hasOne(Language::class,'id', 'main_language');
    }

    public function UserCountry()
    {
        return $this->hasOne(Country::class,'id', 'country');
    }

    public function Projects()
    {
        return $this->hasMany(Project::class,'user_id', 'id');
    }

    public function type()
    {
        return $this->belongsToMany(UserType::class, 'user_user_type', 'user_id', 'user_type_id');
    }
}
