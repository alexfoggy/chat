<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message_id extends Model
{
    protected $table = 'message_id';

    protected $fillable = ['user_id','site_id','user_user_id'];


    public function children()
    {
        return $this->hasMany(Message::class,'message_id', 'id');
    }
}