<?php

namespace App\Http\Middleware;

use Closure;

class AdminAuth
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
        if (auth()->user()->type == 'admin') {
            return $next($request);
        } else {
            return redirect()->route(
                'home'
            )->with('message', 'ليس لديك حق تصفح الصفحة');
        }
    }
}