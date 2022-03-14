<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Sites extends Model
{
    protected $table = 'sites';

    protected $fillable = [
        'site_key',
        'site_route'
    ];


}
