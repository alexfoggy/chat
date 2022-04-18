<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pools extends Model
{
    protected $table = 'pools';

    protected $fillable = ['user_id','title','theme','status','key','url_key'];
}
