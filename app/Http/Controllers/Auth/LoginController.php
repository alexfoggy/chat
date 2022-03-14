<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use http\Env\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //$this->middleware('guest')->except('logout');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
//        Auth::login();

        $user_exist = User::whereEmail($user->getEmail())->first();

        if ($user_exist) {

            Auth::login($user_exist);
            return redirect()->route('cabinet.index', 'dashboard');

        } else {

            $new_user = User::create([
                'first_name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => bcrypt('unicrowd'),
                'token' => generateToken()
            ]);

            $new_user->sendEmailVerificationNotification();

            if ($new_user) {
                Auth::login($new_user);
            }

            return redirect()->route('cabinet.index', 'dashboard');
        }
    }
}
