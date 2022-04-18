<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pool_question extends Model
{
    protected $table = 'pool_question';

    protected $fillable = ['pool_id','title','status','type'];

    public function checkbox()
    {
        return $this->hasMany(Pool_checkbox::class,'pool_question_id', 'id');
    }
}
