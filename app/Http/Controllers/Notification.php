<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Notification extends Controller
{
    public $type;
    public $status;
    public $message;

    public function __construct($type, $status, $message = null)
    {
        $this->status = $status;
        $this->type = $type;
        $this->message = $message;
    }

    public function show()
    {
        return ['message' => "Your $this->type was $this->status. $this->message"];
    }
}
