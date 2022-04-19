<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pool_ans_id extends Model
{
    protected $table = 'pool_ans_id';


    public function children()
    {
        return $this->hasMany(Pool_ans::class,'ans_id', 'id');
    }
}
