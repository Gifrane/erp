<?php

namespace App\Http\Middleware;

use Closure;

use function app;
use function auth;
use function redirect;
use function response;

class CheckUser
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
        if (!auth()->check()) {
            if ($request->ajax()) {
                return response()->json([ 'success' => false, 'errors' => [ 'Not authenticated.' ] ], 403);
            }

            return redirect()->route('auth.login.get');
        }

        $user = auth()->user();

        app()->setLocale($user->lang);

        return $next($request);
    }
}
