<?php

namespace App\Http\Controllers\Admin;

use App\Language;
use App\Period;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periods = Period::all();
        return view('admin.period.index')->with([
            'periods' => $periods,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locales = Language::all();
        return view('admin.period.create')->with([
            'locales'=>$locales,
        ]);
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
            'month'=>'required',
            'discount'=>'required',
        ]);

        Period::create($request->all());
        return redirect()->route('period.index')
            ->with('success', 'Period added');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Period $period)
    {
        return view('admin.period.show', compact('period'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Period $period)
    {
        $locales = Language::all();
        return view('admin.period.edit', compact('period', 'locales'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'month'=>'required',
            'discount'=>'required',
        ]);

        $period=Period::find($id);
        $period->month = $request->month;
        $period->type = $request->type;
        $period->discount = $request->discount;
        $period->save();

        return redirect()->route('period.index')
            ->with('success', 'Period successfully updated');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Period $period)
    {

        $period->delete();


        return redirect()->route('period.index')
            ->with('success','Period deleted successfully');
    }
}
