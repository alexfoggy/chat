<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('sendmessage', 'User\RecordController@sendMsg');

Route::post('checkResponse', 'User\RecordController@checkIfAns');
Route::post('checkme', 'User\RecordController@checkIfKeyWorks');

Route::post('history', 'User\RecordController@history');
