<?php

use App\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'PageController@main')->name('main');
Route::get('/instruction', 'PageController@inctruction');
Route::get('/price', 'PageController@price');
Route::get('/docs', 'PageController@docs');
Route::get('/pool/{key?}', 'Admin\PoolsController@poolAsk');
Route::post('/sendform/{key?}', 'Admin\PoolsController@poolSave');


Route::get('/chanel', function () {
    response()->json(['hello' => 'response']);
});


//Route::get('yourkey/{id?}', 'PageController@domainKeyInfo');


Route::get('/profile', 'PageController@profile')->name('profile');
Route::get('/about', 'PageController@about')->name('about');

Route::post('/lang', 'LanguageController@changeLang')->name('about');


Route::get('login/google', 'Auth\LoginController@redirectToProvider')->name('register.google');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');

\Illuminate\Support\Facades\Auth::routes(['verify' => true]);

require 'speaker.php'; // Speaker Routes

//require 'admin.php'; // Admin Routes
//
//require 'manager.php'; // Manager Routes

Route::get('/test', function () {
    echo '<pre>';
    return \App\Models\Project::with('tasks')->first();
});
//Route::get('/home', 'HomeController@index')->name('home');

// Return to registration
Route::get('returnregister', function () {
    Auth::logout();
    return redirect('/register');
});

Route::get('accountOut', function () {
    Auth::logout();
    return redirect('/');
});

