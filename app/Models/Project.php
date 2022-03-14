<?php

namespace App\Models;

use App\Traits\FileTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    use FileTrait;

    protected $fillable = [
        "user_id",
        "title",
        "country",
        "language",
        "speakers",
        "dialect",
        "tasks_count",
        "tasks_per_speaker",
        "minutes_per_tasks",
        "budget",
        "subject",
        "environment",
        "type",
        "rules",
        "script",
        "voice",
        "apply_deadline",
        "complete_deadline",
        "status",
        'format',
        "time",
        "time_type",
        "uploadAction"
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id', 'id');

    }

    function lang()
    {
        return $this->hasOne(Language::class, 'id', 'language');

    }

    function countryOne()
    {
        return $this->hasOne(Country::class, 'id', 'country');

    }

    function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');

    }

    public function language()
    {
        return $this->morphToMany(Language::class, 'languageable', 'languageables');
    }
}
