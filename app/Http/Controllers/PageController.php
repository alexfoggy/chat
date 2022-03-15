<?php

namespace App\Http\Controllers;

use App\Models\Sites;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function main()
    {
        dd(1);
        $users = User::get();

        return view('pages.main',get_defined_vars());
    }

    public function domainKeyInfo(Request $request,$id)
    {
        $site = Sites::where('id',$id)->first();


        return view('pages.keypage',get_defined_vars());
    }

    public function about()
    {
        return view();
    }
}
