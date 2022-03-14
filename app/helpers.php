<?php


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

