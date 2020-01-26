<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;
class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (Auth::guest()) {
            throw UnauthorizedException::notLoggedIn();
        }
        $roles = is_array($role)
            ? $role
            : explode('|', $role);
        if (!Auth::user()->hasAnyRole($roles)) {
            if(Auth::user()->hasRole('super-admin') or Auth::user()->hasRole('admin')){
                return redirect()->route('admin.home');
            } else if(Auth::user()->hasRole('be')){
                return redirect()->route('be.home');
            }else if(Auth::user()->hasRole('user')){
                return redirect()->route('frontend.index');
            }else{
                return redirect()->route('frontend.index');
            }
        }
        return $next($request);
    }
}
