<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function main()
    {
        return view('pages.main');
    }

    public function profile()
    {
        $user = Auth::user();

        if($user) {
            return view('pages.profile', get_defined_vars());
        }
        else {
            abort(404);
        }
    }

    public function about()
    {
        return view();
    }
}
