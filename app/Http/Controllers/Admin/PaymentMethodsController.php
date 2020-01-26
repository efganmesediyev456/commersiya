<?php

namespace App\Http\Controllers\Admin;

use App\Language;
use App\PaymentMethod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class PaymentMethodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $payment_methods=PaymentMethod::all();
        return view('admin.payment_methods.index')-> with([
            'payment_methods' => $payment_methods,
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
        return view('admin.payment_methods.create')->with([
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
            'address'=>'required',
            'job_date'=>'required',
            'phone'=>'required',
            'map_link'=>'required',
            'name'=>'required',
            'image'=>'required',
        ]);

//image upload
        if(!File::exists('uploads/payment_methods')){
            mkdir(asset('uploads/payment_methods'));
        }
        $image=$request->file('image');
        $image_name=uniqid().'.'.$image->getClientOriginalExtension();
        $image->move('uploads/payment_methods',$image_name);


        $payment_method=new PaymentMethod();
        $payment_method->address=$request->address;
        $payment_method->job_date=$request->job_date;
        $payment_method->phone=$request->phone;
        $payment_method->map_link=$request->map_link;
        $payment_method->image=$image_name;
        $payment_method->name=$request->name;

        $payment_method->save();


        return redirect()->route('payment_methods.index')
            ->with('success', 'Payment Method Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMethod $payment_method)
    {
        return view('admin.payment_methods.show', compact('payment_method'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentMethod $payment_method)
    {
        $locales = Language::all();
        return view('admin.payment_methods.edit', compact('payment_method', 'locales'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentMethod $payment_method)
    {



        $request->validate([
            'address'=>'required',
            'job_date'=>'required',
            'phone'=>'required',
            'map_link'=>'required',
            'name'=>'required',
        ]);



        $image_name=$payment_method->image;

        if($request->hasFile('image')){

            if(!File::exists('uploads/payment_methods')){
                mkdir(asset('uploads/payment_methods'));
            }

            $image=$request->file('image');
            $image_name=uniqid().'.'.$image->getClientOriginalExtension();
            $image->move('uploads/payment_methods',$image_name);

            $old_image=$payment_method->image;
            if(File::exists('uploads/payment_methods/'.$old_image)){
                File::delete('uploads/payment_methods/'.$old_image);
            }
        }


        $payment_method->address = $request->address;
        $payment_method->map_link = $request->map_link;
        $payment_method->job_date = $request->job_date;
        $payment_method->phone = $request->phone;
        $payment_method->name = $request->name;
        $payment_method->image=$image_name;
        $payment_method->save();


        return redirect()->route('payment_methods.index')
            ->with('success', 'Payment Methods successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethod $payment_method)
    {
        $image=$payment_method->image;
        if(File::exists('uploads/payment_methods/'.$image)){
            File::delete('uploads/payment_methods/'.$image);
        }

        $payment_method->delete();


        return redirect()->route('payment_methods.index')
            ->with('success','Payment Methods deleted successfully');
    }
}
