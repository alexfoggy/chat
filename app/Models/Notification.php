<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notification';

    protected $fillable = ['user_id', 'message', 'status','type', 'url', 'clikable', 'status'];

}
