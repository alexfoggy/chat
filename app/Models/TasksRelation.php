<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
//use Ramsey\Uuid\Uuid;

class TasksRelation extends Model
{
    protected $table = 'tasks_relation';

    protected $fillable = [
        'user_id',
        'task_id',
    ];

//    protected static function boot()
//    {
//        parent::boot(); // TODO: Now generated uuid, not id
//
//        static::creating(function (Model $model) {
//            $model->setAttribute('uuid', Uuid::uuid4());
//        });
//    }


    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
    public function task()
    {
        return $this->hasOne(Sites::class, 'id', 'task_id');
    }

    public function languages()
    {
        return $this->morphToMany(Language::class, 'languageable', 'languageables');
    }

    public function records()
    {
        return $this->morphedByMany(Record::class,'taskable', 'taskables', 'task_uuid', 'taskable_id', 'uuid', 'id');
    }

}
