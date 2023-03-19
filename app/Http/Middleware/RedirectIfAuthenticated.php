<?php

namespace App\Http\Middleware;

use Closure;

use function auth;
use function redirect;

class RedirectIfAuthenticated
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
        if (auth()->check()) {
            return redirect('/');
        }

        return $next($request);
    }
}
