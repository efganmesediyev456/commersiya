<?php

namespace App\Http\Middleware;

use Closure;

class CheckBeUser
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
        if ($request->user()->status == 1) {
            return $next($request);
        }
        else {
            return redirect()->route('admin.home');
        }
    }
}
