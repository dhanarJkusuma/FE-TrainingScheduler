<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsPelatih
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
        if (Auth::user() &&  Auth::user()->status == 'pelatih') {
            return $next($request);
        }

        return redirect('/');
    }
}
