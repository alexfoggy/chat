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
Route::get('/profile', 'PageController@profile')->name('profile');
Route::get('/about', 'PageController@about')->name('about');

Route::post('/lang', 'LanguageController@changeLang')->name('about');

Route::get('/interface', function () {
    return view('ui.ui');
});

Route::get('login/google', 'Auth\LoginController@redirectToProvider')->name('register.google');
Route::get('login/google/callback', 'Auth\LoginController@handleProviderCallback');

\Illuminate\Support\Facades\Auth::routes(['verify' => true]);

require 'speaker.php'; // Speaker Routes

require 'admin.php'; // Admin Routes

require 'manager.php'; // Manager Routes

Route::get('/test', function () {
    echo '<pre>';
    return \App\Models\Project::with('tasks')->first();
});
//Route::get('/home', 'HomeController@index')->name('home');

Route::post('/sanctum/token', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken($request->device_name)->plainTextToken;
});

Route::get('mail', function () {
    return (new \App\Notifications\NewTaskNotification(User::first()))->toMail(User::first());
});


// paypal change email
Route::get('paypal/email/{token}','User\ProfileController@paypalEmailPage');

// LOG OUT
Route::get('accountOut',function (){
    Auth::logout();
    return redirect('/');
});

