<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $table = 'form';

    protected $fillable = ['user_id','site_id','formkey','head','type'];
}
