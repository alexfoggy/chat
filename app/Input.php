<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Input extends Model
{
    protected $table = 'input';

    protected $fillable = ['form_id','type','placeholder','title','position'];
}