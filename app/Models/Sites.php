<?php

namespace App\Models;

use App\Form;
use App\Input;
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
        'site_user_role',
        'test_status'
    ];

    public function forms()
    {
        return $this->hasMany(Form::class,'site_id', 'id');
    }


}
