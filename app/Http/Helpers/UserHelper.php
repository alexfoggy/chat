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
        $this->userType();
        $this->getRoute();
    }

    private function userType()
    {
        $type_title = @UserType::find($this->user->type()->first()->id)->title;
        return $this->type = $type_title ?? 'speaker';
    }

    private function getRoute()
    {
        switch ($this->userType()) {
            case('admin') :
                $this->route = '/admin';
                break;
            case('project_manager') :
                $this->route = '/manager';
                break;
            case('speaker') :
            default:
                $this->route = '/cabinet';
                break;
        }

        return $this->route;
    }
}
