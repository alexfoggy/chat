<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Task extends Model
{
    protected $fillable = [
        'uuid',
        'project_id',
        'user_id',
        'title',
        'price',
        'description',
        'length',
        'budget',
        'invoice_date',
        'status',
        'complete_status',
        'apply_deadline',
        'complete_deadline',
        'remind_date'
    ];

    protected static function boot()
    {
        parent::boot(); // TODO: Now generated uuid, not id

        static::creating(function (Model $model) {
            $model->setAttribute('uuid', Uuid::uuid4());
        });
    }


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
        return $this->hasOne(Task::class, 'id', 'task_id');
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
