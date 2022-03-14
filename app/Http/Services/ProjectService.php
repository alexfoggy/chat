<?php

namespace App\Http\Services;

use Carbon\Carbon;

class ProjectService
{
    public static function getAproxTime($project)
    {

        $time = $project->time / $project->speakers;
        $time_original = $project->time / $project->speakers;
        $time_val = 'Min';
        if ($time >= 60) {
            $time = $time / 60;
        } else {
            $time_val = 'Seconds';
        }

        return 'time for every speaker:' . $time . ' ' . $time_val . ' or ' . $time_original . ' seconds';
    }

    public static function getAproxPrice($project)
    {
        $price = $project->budget / $project->speakers;

        return 'price per speaker ' . $price;
    }

    public static function getStatusUsersCount($project, $tasks, $speakers,$timeTasked)
    {
        if ($tasks->count() + $speakers->count() < $project->speakers && $timeTasked < $project->time) {
            return true;
        } else {
            return false;
        }
    }

}
