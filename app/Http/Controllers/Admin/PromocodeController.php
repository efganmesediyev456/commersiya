<?php

namespace App\Http\Controllers\Admin;

use App\Promocodes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PromocodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promocodes = Promocodes::all();
        return view('admin.promocode.index', compact('promocodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.promocode.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
           'code' => 'required',
           'deadline' => 'required',
           'discount' => 'required'
        ]);
        Promocodes::create($request->all());
        return redirect()->route('promocode.index')->with('success','Promo code successfully created');
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
    public function edit(Promocodes $promocode)
    {
        $time = explode(' ', $promocode->deadline);
        $promocode->deadline = $time[0];
        return view('admin.promocode.edit', compact('promocode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promocodes $promocode)
    {
        $this->validate($request, [
            'code' => 'required',
            'deadline' => 'required',
            'discount' => 'required',
        ]);
        $promocode->code = $request->code;
        $promocode->deadline = $request->deadline;
        $promocode->discount = $request->discount;

        if($promocode->save()){
            return redirect()->route('promocode.index')->with('success', 'Promocode succesfully updated');
        }
        else{
            return redirect()->back()->withInput()->with('error', 'Something went wrong, please repeat again');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function acticate()
    {

    }
}
