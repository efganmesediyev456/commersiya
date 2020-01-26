<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;

class AdminLoginController extends Controller
{
    /**
     * Show the application’s login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    protected function guard(){
        return Auth::guard('admin');
    }

    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
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
                $this->logoutHandler($request);
                $errors = [$this->username() => trans('auth.noAdmin')];
                return redirect()->back()
                    ->withInput($request->only($this->username(), 'remember'))
                    ->withErrors($errors);
            }
        }
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);

    }

    public function logout(Request $request)
    {
        $this->logoutHandler($request);
        return redirect()->guest(route('admin.login'));
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
