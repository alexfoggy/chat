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

Route::get('todo', 'Todo@index');

Route::post('todo/create', 'Todo@create');
Route::post('todo/delete', 'Todo@delete');
Route::post('todo/changestatus', 'Todo@changestatus');
Route::post('todo/update', 'Todo@update');

Route::post('todo/comment/create', 'Todo@commentCreate');
Route::get('todo/comment/show/{id?}', 'Todo@commentShow');
Route::post('todo/comment/delete', 'Todo@commentDelete');

