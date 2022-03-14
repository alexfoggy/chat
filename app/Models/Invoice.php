<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'speaker_id',
        'task_uuids',
        'status'
    ];

    public function tasks()
    {
        $tasks = explode('|', $this['task_uuids']);
        return $this->tasks = Task::whereIn('uuid', $tasks)->get();
    }
}
