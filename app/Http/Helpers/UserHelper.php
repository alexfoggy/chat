<?php


namespace App\Http\Helpers;


use App\Models\UserType;
use App\User;

class UserHelper
{
    public $user;
    public $type;
    public $route;

    public function __construct($user = null)
    {
        $this->user = $user;
        $this->getRoute();
    }


    private function getRoute()
    {
        $this->type = $this->user->type;
        switch ($this->user->type) {
            case('user') :
                $this->route = '/cabinet';
                break;
            case('admin') :
                $this->route = '/manager';
                break;
            default:
                $this->route = '/';
                break;
        }

        return $this;
    }
}
