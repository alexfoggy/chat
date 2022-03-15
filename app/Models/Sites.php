<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Sites extends Model
{
    protected $table = 'sites';

    protected $fillable = [
        'user_id',
        'site_key',
        'site_route',
        'site_image',
        'site_user_name',
        'site_role',
        'test_status'
    ];


}
