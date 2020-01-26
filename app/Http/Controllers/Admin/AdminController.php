<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Contact;
use App\Coupon;
use App\Http\Controllers\Controller;
use App\License;
use App\Payment;
use App\Subscription;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.admin-home');
    }


    public function readAllMessages()
    {
        DB::table('contact')
            ->where('read', 0)
            ->update(['read' => 1]);
        return true;
    }


    public function profile()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('admin'));
    }


    public function changePass(Request $request,$id)
    {
        $this->validate($request, [
           'current'=> 'required',
           'newpass' => 'required',
           'confirm' => 'required'
        ]);
        $admin = User::find($id);
        if (password_verify($request->current,$admin->password)) {
            if ($request->newpass == $request->confirm) {
                $password = Hash::make($request->newpass);
                $admin->password = $password;
                if ($admin->save()) {
                    return redirect()->back()->with('success','Password successfully changed');
                }
                else{
                    return redirect()->back()->with('error','Something went wrong, please try again');
                }
            }
            else {
                return redirect()->back()->with('error','Passwords don\'t match');
            }
        }
        else{
            return redirect()->back()->with('error','Current password is not correct');
        }
    }


}
