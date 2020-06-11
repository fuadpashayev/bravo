<?php

namespace App\Http\Middleware;
use Closure;

class Language
{
    public function handle($request, Closure $next)
    {
        if(session()->has('language'))
            app()->setLocale(session('language'));
        else
            app()->setLocale(config('app.locale'));

        return $next($request);
    }

}