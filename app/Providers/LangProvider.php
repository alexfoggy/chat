<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use PhpParser\Node\Expr\Variable;

class LangProvider extends ServiceProvider
{

    protected $lang;

    public function boot()
    {
        View::composer('*', function ($view) {
            $lang = Cookie::get('lang');
            $view->lang = $lang;
        });
       // return new Variable('lang',$lang);
    }
}
