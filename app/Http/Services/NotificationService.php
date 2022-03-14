<?php

namespace App\Http\Services;

use Carbon\Carbon;
use App\Models\Notification;

class NotificationService
{
    public static function notify($user,$type,$msg,$clickble,$url = null){

    $notif = new Notification();

    $notif->user_id = $user->id;
    $notif->message = $msg;
    $notif->url = $url;
    $notif->type = $type;
    $notif->clickable = $clickble ? 1 : 0;
    $notif->status = 0;

    $notif->save();

}

}
