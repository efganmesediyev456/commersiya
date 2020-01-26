<?php

namespace App\Http\Controllers\Be;

use App\Admin;
use App\Http\Controllers\Controller;
use App\License;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $montly_user_count = User::where('created_at','>',date('Y-m').'-1 00:00:00')->where('type','=',1)->count();
        $daily_user_count= User::where('created_at','>',date('Y-m-d').' 00:00:00')->count();


        $users = User::where('type', 1)->limit(10)->get();
        return view('be.index', compact('users', 'montly_user_count','daily_user_count'));
    }


    public function register()
    {
       if (Auth::guard('admin'))  {
           return redirect()->route('be.home');
       }
       else {
           return view('be.register');

       }
    }

    public function registerUser(Request $request)
    {
        $this->validate($request, [
           'email' => 'required',
           'password' => 'required',
           'confirm' => 'required',
        ]);
        $user = new Admin();
        if ($request->password == $request->confirm){
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->status = 1;
            if ($user->save()) {
                return redirect()->route('admin.login')->with('success', 'User Successfully created');
            }
            else {
                return redirect()->back()->withInput()->with('error', "Something went wrong");

            }
        }
        else {
            return redirect()->back()->withInput()->with('error', "Passwords don't match");
        }
    }
}
