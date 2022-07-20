<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;


class Backoffice
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (Cookie::get('admin_cookie') !== null) {

            return $next($request);
        } else {
            return redirect()->route('pageLogin2');
        }
    }
}
