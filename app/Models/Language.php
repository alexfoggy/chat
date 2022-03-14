<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = ['name', 'script', 'locale', 'native', 'regional', 'status'];

    public function dialect()
    {
        return $this->hasMany(Dialect::class, 'language_id','id');
    }

    public function tasks()
    {
        return $this->morphedByMany(Task::class,'languageable','languageables');
    }

    public function project()
    {
        return $this->morphedByMany(Project::class,'languageable', 'languageables');
    }

    public function user()
    {
        return $this->morphedByMany(User::class,'languageable', 'languageables');
    }

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'country_language');
    }
}
