<?php

namespace App\Http\Controllers\Auth;

use App\About;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/profile';



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function showLoginForm()
    {
        $conditions = About::where('key','conditions')->first();
        if(!$conditions) {
            $conditions = '';
        }
        return view('auth.login',compact('conditions'));

    }

    public function login(Request $request)
    {
        //5 sehv gedis varsa 1 deq gozle
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        $this->validateLogin($request);
        $user = ['email' => $request->email, 'password' => $request->password];
        Auth::attempt($user);
        if (Auth::guard('admin')->attempt($user)) {
            $user = Auth::guard('admin')->user();

            if ($user->hasRole('admin')) {
                return redirect()->route('admin.home');
            } else if ($user->hasRole('be')) {
                return redirect()->route('be.home');
            } else if ($user->hasRole('user')) {
                return $this->sendLoginResponse($request);
                return redirect()->route('frontend.index');
            }
        }
        $this->incrementLoginAttempts($request);
        return redirect()->route('profile');
//        return $this->sendFailedLoginResponse($request);

    }

    public function logout(Request $request)
    {
        $this->logoutHandler($request);
        return redirect()->guest(route('login'));
    }

    private function logoutHandler(Request $request)
    {

        Auth::guard('admin')->logout();
        $request->session()->flush();
        $request->session()->regenerate();

    }

    protected function hasTooManyLoginAttempts(Request $request)
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), $this->maxAttempts()
        );
    }

    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );
        throw ValidationException::withMessages([
            $this->username() => [Lang::get('auth.throttle', ['seconds' => $seconds])],
        ])->status(Response::HTTP_TOO_MANY_REQUESTS);
    }
}
