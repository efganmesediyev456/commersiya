<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class Localization
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
        if(Session::get('locale')) {
            $lang = Session::get('locale');
            App::setLocale($lang);
        }
        // Configden gelmelidi TODO
        else {
            App::setLocale('az');
        }
        return $next($request);
    }
}

