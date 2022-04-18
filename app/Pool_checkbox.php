<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pool_checkbox extends Model
{
    protected $table = 'pool_checkbox';

    protected $fillable = ['pool_question_id','title'];
}
