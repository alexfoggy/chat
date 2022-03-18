<?php
use Illuminate\Support\Facades\Route;


Route::prefix('cabinet')->name('cabinet.')->middleware(['auth', 'verified', 'user.type:user', 'web'])->group(function () {
    //GET
    Route::get('/', 'Admin\SpeakerController@index');
    Route::get('/newsite', 'Admin\SpeakerController@newsite');
    Route::get('/domains', 'Admin\SpeakerController@domainslist');
    Route::get('/domain/{id?}', 'Admin\SpeakerController@oneDomain');
    Route::get('/chats', 'Admin\SpeakerController@chatList');

    //POST
    Route::post('createNewConnection', 'Controller@createConnection');
    Route::post('createNewConnectionTest', 'Controller@createConnectionTest');
    Route::post('deletedomain', 'Controller@deleteDomain');
    Route::get('/edit', 'Admin\SpeakerController@editPage')->name('edit');
    Route::post('/edit', 'Admin\SpeakerController@editSave');

    Route::get('settings','Admin\SpeakerController@settingsPage');
    Route::get('tasks','Admin\TaskController@speakerTaskList');
    Route::get('task/{id?}','Admin\TaskController@speakerTaskDetail');

    Route::post('/tasks/decline', 'Admin\TaskController@decline');

    //settings
    Route::post('/setting/changepassword', 'User\ProfileController@changePass');
    Route::post('/setting/paypalChangeEmail', 'User\ProfileController@paypalChangeEmail');
    Route::post('/setting/paypalChangeEmailSave', 'User\ProfileController@paypalChangeEmailSave');

    //Route::post('/sendRecord', 'User\RecordController@store');
    Route::resource('invoices', 'User\InvoiceController');
    Route::post('/generate-invoice', 'Admin\TaskController@generateInvoice');
});
