<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class NotificationProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('components.admin.nav', function ($view) {

            $notif = Notification::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->limit(10)->get();

            $view->notif = $notif;
        });
    }
}
