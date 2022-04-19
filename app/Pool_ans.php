<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pool_ans extends Model
{
    protected $table = 'pool_ans';

    protected $fillable = ['pool_question_id','title'];

    public function nameCheckbox()
    {
        return $this->hasOne(Pool_checkbox::class,'id', 'checkbox_id');
    }
}