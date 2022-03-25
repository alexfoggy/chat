<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'message';
    protected $fillable = ['message_id','input_id','msg_value'];

    public function input()
    {
        return $this->hasOne(Input::class,'id', 'input_id');
    }

}
