<?php

namespace App\Http\Middleware;

use Closure;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (auth()->user()->type == 'user') {
            return $next($request);
        } else {
            return redirect()->route(
                'home'
            )->with('message', 'ليس لديك حق تصفح الصفحة');
        }
    }
}