<?php

namespace App\Http\Controllers\Admin;

use App\Language;
use App\MinistraClient;
use App\Package;
use App\Tariff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TariffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tariffs = Tariff::orderby('id','desc')->get();
        return view('admin.tarif.index',compact('tariffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locales = Language::all();
        $ministra = new MinistraClient();
        $packages = $ministra->getData('tariffs')->results;
        $site_packages = Package::all();
        return view('admin.tarif.create', compact('locales', 'packages', 'site_packages'));
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
            'name' => 'required|array|min:1',
            'price' => 'required',
            'icon' => 'required',
        ]);
        $tariff = new Tariff();
        if($request->is_active){
            $tariff->is_active =1;
        }
        else{
            $tariff->is_active =0;
        }
        $tariff->name = $request->name;
        $tariff->detail = $request->detail;
        $tariff->type = $request->type;
        $tariff->ministra_id = $request->ministra_id;
        $tariff->price = $request->price;
        $tariff->icon = $request->icon;
        $tariff->save();
        if ($tariff->type == 1) {
            $tariff->default()->attach($request->default);
        }
        return redirect()->route('tariff.index')
            ->with('success', 'Tariff successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tariff $tariff)
    {
        return view('admin.tarif.show', compact('tariff'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tariff $tariff)
    {
       $choose_packages=$tariff->default->pluck('id')->toArray();

        $locales = Language::all();
        $ministra = new MinistraClient();
        $packages = $ministra->getData('tariffs')->results;
        $site_packages = Package::all();
        return view('admin.tarif.edit', compact('locales', 'tariff', 'packages', 'site_packages','choose_packages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tariff $tariff)
    {
        $request->validate([
            'name' => 'required|array|min:1',
            'price' => 'required',
            'icon' => 'required',
            'detail' => 'required'
        ]);
        if($request->is_active){
            $tariff->is_active =1;
        }
        else{
            $tariff->is_active =0;
        }
        $tariff->name = $request->name;
        $tariff->detail = $request->detail;
        $tariff->type = $request->type;
        $tariff->ministra_id = $request->ministra_id;
        $tariff->price = $request->price;
        $tariff->icon = $request->icon;
        $tariff->save();
        if ($tariff->type == 1) {
            $tariff->default()->sync($request->default);
        }

        return redirect()->route('tariff.index')
            ->with('success', 'Tariff successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tariff $tariff)
    {
        $tariff->default()->detach();
        $tariff->delete();
        return redirect()->route('tariff.index')->with('success','Tariff successfully deleted');
    }
}
