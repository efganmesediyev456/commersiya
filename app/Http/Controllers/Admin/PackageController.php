<?php

namespace App\Http\Controllers\Admin;

use App\Language;
use App\MinistraClient;
use App\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::all();
        $ministra = new MinistraClient();
        $ministras = $ministra->getData('services_package')->results;
//        foreach ($ministras as $min) {
//            echo $min->name;
//            echo '<br>';
//        }

        return view('admin.package.index', compact('packages','ministras'));
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
        $packages = $ministra->getData('services_package')->results;
        return view('admin.package.create', compact('locales', 'packages'));
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
            'name.*' => 'required|string',
            'price' => 'required',
            'ministra_id' => 'required'
        ]);
        Package::create($request->all());
        return redirect()->route('package.index')
            ->with('success', 'Package added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        $locales = Language::all();
        $ministra = new MinistraClient();
        $packages = $ministra->getData('services_package')->results;
        return view('admin.package.edit', compact('package', 'locales', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'ministra_id' => 'required'
        ]);
        $package->update($request->all());
        return redirect()->route('package.index')
            ->with('success', 'Package successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function activate(Request $request)
    {
        $package = Package::find($request->id);
        $package->is_active = !$package->is_active;
        $package->save();
    }


    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('package.index')
            ->with('success','Package deleted successfully');
    }
}
