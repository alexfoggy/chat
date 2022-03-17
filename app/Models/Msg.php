<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Msg extends Model
{
    protected $table = 'msg';

    protected $fillable = [
        'user_id', 'site_id', 'chat_id','msg','userStatus'
    ];
}
