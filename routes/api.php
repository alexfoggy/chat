<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('sendmessage', 'User\RecordController@sendMsg');

Route::post('sendmsgpanel', 'User\RecordController@sendmsgpanel');

Route::post('checkResponse', 'User\RecordController@checkIfAns');
Route::post('checkResponsePanel', 'User\RecordController@checkResponsePanel');

Route::post('checkme', 'User\RecordController@checkIfKeyWorks');

Route::post('changechat', 'User\RecordController@changeChat');

Route::post('history', 'User\RecordController@history');

Route::post('sendform/{sitekey?}/{session?}', 'User\RecordController@sendForm');
