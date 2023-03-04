<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PreventBackBooking
{
public function handle($request, Closure $next)
{
    $response = $next($request);

    return $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
                    ->header('Pragma','no-cache')
                    ->header('Expires','Sun, 02 Jan 1990 00:00:00 GMT');
}
}