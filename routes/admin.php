<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'user.type:admin'])->group(function () {

    Route::get('/', 'Admin\AdminController@index');

    Route::get('/create', 'Admin\ProjectController@createIndex');
    Route::post('/createProject', 'Admin\ProjectController@saveProject');
    Route::get('/projects', 'Admin\AdminController@projectsList');
    Route::get('/project/{id}', 'Admin\ProjectController@projectPage');
    Route::get('/task/{id}', 'Admin\TaskController@taskPageManager');
    Route::get('/userinfo/{id}', 'User\ProfileController@getProfileUser');
    Route::get('/speakers', 'Admin\AdminController@speakersList');
    Route::get('/pmlist', 'Admin\AdminController@pmList');
    Route::get('/create-user', 'Admin\AdminController@createUser');
    Route::get('/translates', 'Admin\AdminController@translates');

    Route::post('/langSaveTranslate', 'Admin\AdminController@translatesSave');
    Route::post('/autoTaskCreator', 'Admin\TaskController@AutoTaskCreator');

    Route::post('/recordStatusChange', 'User\RecordController@recordStatusChange');
    Route::post('/tasksCreation', 'Admin\TaskController@multiTasksCreation');
    Route::post('/task/edit', 'Admin\TaskController@taskEdit');

    //Create new PM
    Route::post('/generateNewProjectManager', 'Admin\AdminController@newProjectManager');



   // Route::view('/{any?}', 'front')->name('index');
});
