<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Filters\UserFilter;
use App\Language;
use App\License;
use App\Service;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, UserFilter $filters)
    {
        $users=$user->filter($filters)->paginate();

        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::all();

        return view('admin.user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|alpha_dash|alpha_dash|regex:/^[a-zA-Z]{1}/',
            'email'=>'required|unique:users,email|email',
            'password'=>'required|confirmed',
            'password_confirmation'=>'required',
        ]);

        $user=new User([
            'name'=>$request->name,
            'password'=>Hash::make($request->password),
            'email'=>$request->email,
            'account_number' => User::generateAccountNumber(),
        ]);

        $user->save();
        $user->assignRole($request->role);

        return redirect()->route('user.index')->with('success', 'User Added');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles=Role::all();
        return view('admin.user.edit',compact('roles', 'user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {


        $request->validate([
            'name'=>'required|alpha_dash|alpha_dash|regex:/^[a-zA-Z]{1}/',
            'email'=>'required|email|unique:users,email,'.$user->id,
            'password_confirmation'=>'required_with:password|same:password'
        ]);


        $user->name=$request->name;
        $user->email=$request->email;
        $user->syncRoles($request->role);

        if($request->has('password') and  !empty($request->password)){
            $user->password=Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'User Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(User $user)
    {
        License::where('user_id',$user->id)->delete();
        Service::where('account_number',$user->account_number)->delete();
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User successfully deleted');
    }

    public function modal(Request $request){
        $user=User::find($request->id);
        $orders=$user->orders;
        return view('admin.ajax.user_modal',['orders'=>$orders])->render();
    }
}
