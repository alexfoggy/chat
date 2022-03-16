<?php


use App\Models\msg;

function getTime($allTime)
{
    $minutes = intval($allTime / 60);
    $sec = intval($allTime - ($minutes * 60));

    if ($sec < 10) {
        $sec = '0' . $sec;
    }
    if ($minutes < 10) {
        $minutes = '0' . $minutes;
    }

    return $time = $minutes . ':' . $sec;
}

function getLast($user_id,$site_id){
    return msg::where('user_id',$user_id)->where('site_id',$site_id)->select('msg')->orderBy('created_at','DESC')->first()->msg;
}
