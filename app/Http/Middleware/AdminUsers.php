<?php

namespace App\Http\Middleware;

use Closure;

class AdminUsers
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
        if(auth()->user()->user_type !== 'admin'){
            return redirect('/');
        }
        return $next($request);
    }
}
