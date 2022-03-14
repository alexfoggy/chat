<?php

use Illuminate\Support\Facades\Route;
Route::get('/langs', 'LanguageController@index')->name('languages');
Route::prefix('manager')->name('manager.')->middleware(['auth', 'verified', 'user.type:project_manager'])->group(function () {

    Route::get('/', 'Admin\ManagerController@index');
    Route::get('/create', 'Admin\ProjectController@createIndex');
    Route::post('/createProject', 'Admin\ProjectController@saveProject');
    Route::get('/projects', 'Admin\ProjectController@projectsList');
    Route::get('/project/{id}', 'Admin\ProjectController@projectPage');
    Route::get('/task/{id}', 'Admin\TaskController@taskPageManager');
    Route::get('/userinfo/{id}', 'User\ProfileController@getProfileUser');
    Route::get('/settings','Admin\SpeakerController@settingsPage');

    Route::post('/setting/changepassword', 'User\ProfileController@changePass');
    Route::post('/recordStatusChange', 'User\RecordController@recordStatusChange');
    Route::post('/tasksCreation', 'Admin\TaskController@multiTasksCreation');
    Route::post('/task/edit', 'Admin\TaskController@taskEdit');


    //    Route::post('/projects/generate', 'Admin\ProjectController@generateTasks');
//    Route::get('projects/{id}/tasks', 'Admin\ProjectController@getTaskList');
    //Route::resource('projects', 'Admin\ProjectController');

   /* Route::view('/{any?}/{options?}', 'front')
        /*->where('any', ".*")
        ->where('options', ".*")*/
//    Route::view('/{any?}', 'front')->name('index');

});
