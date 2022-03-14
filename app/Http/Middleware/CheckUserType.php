<?php

namespace App\Http\Middleware;

use App\Http\Helpers\UserHelper;
use App\Models\UserType;
use Closure;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $type)
    {
        $user_type = new UserHelper(auth()->user());

        if($user_type->type !== $type) {
            return redirect()->back();
        }

        return $next($request);
    }
}
