<?php

namespace App\Http\Services;

use App\Models\msg;
use App\Models\Record;
use Carbon\Carbon;

class RecordService
{

    public static function getLast($user_id,$task_id){
        return msg::where('user_id',$user_id)->where('task_id',$task_id)->select('msg')->orderBy('created_at','desc')->first();
    }

    public static function getTime($records)
    {

        $allTime = $records->pluck('duration')->sum();

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

    public static function checkIfCanBeApproved($task)
    {
        $records = Record::where('task_id', $task->id)->pluck('duration')->sum();
        if ($records >= $task->length) return true;
        return false;
    }


}
