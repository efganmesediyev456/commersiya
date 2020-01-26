<?php

namespace App\Http\Controllers\Admin;

use App\License;
use App\Package;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LicenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $licenses = License::orderby('id','desc')->get();
        return view('admin.license.index', compact('licenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('admin.license.create', compact('users'));
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
            'license' => 'required',
        ]);
        if($request->is_active){
            $active =1;
        }
        else{
            $active =0;
        }
        $all = $request->license;
        $all = trim($all);
        $all = rtrim($all,',');
        $all = explode(',',$all);
        $licenses = [];
        foreach ($all as $license) {
            $license = trim($license);
            $save_license = new License();
            $save_license->created_by = 'Admin';
            $save_license->is_active = $active;
            $save_license->license = $license;
            $save_license->save();
        }
        return redirect()->route('license.index')
            ->with('success', 'License added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(License $license)
    {
        return view('admin.license.show',compact('license'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(License $license)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, License $license)
    {
    }

    public function activate(Request $request)
    {
        $license = License::find($request->id);
        $license->is_active = !$license->is_active;
        $license->save();
    }

    public function status(Request $request)
    {
        $license = License::find($request->id);
        $license->status = !$license->status;
        $license->save();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(License $license)
    {
        $license->delete();
        return redirect()->route('license.index')
            ->with('success','License deleted successfully');
    }
}
