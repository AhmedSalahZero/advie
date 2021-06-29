<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Localization
{
    public function handle(Request $request, Closure $next)
    {
        if (! in_array(request()->segment(1), ['en', 'ar'])) {

            return redirect()->to('/en');
        }

        if ($request->lang <> '') {
            app()->setLocale($request->lang);
        } else {
            app()->setLocale('en');

            return redirect()->to('/en');
        }

        return $next($request);
    }
}
