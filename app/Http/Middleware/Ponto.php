<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;


class Ponto
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

        if (Cookie::get('pinCokie') !== null) {

            return $next($request);
            
        } else {
            return redirect()->route('homePage');
        }
    }
}
