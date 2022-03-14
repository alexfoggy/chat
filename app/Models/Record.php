<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = ['user_id','task_id', 'name', 'duration', 'path', 'validated'];

    public function tasks()
    {
        return $this->morphToMany(Sites::class,'taskable', 'taskables', 'taskable_id', 'id');
    }
}
