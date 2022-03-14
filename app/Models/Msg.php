<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class msg extends Model
{
    protected $table = 'msg';

    protected $fillable = [
        'user_id', 'site_id', 'msg','userStatus'
    ];

}
