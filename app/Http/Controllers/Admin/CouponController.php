<?php

namespace App\Http\Controllers\Admin;

use App\Filters\CouponFilter;
use App\Period;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Coupon;
use Faker\Generator as Faker;
use App\Subscription;
use phpDocumentor\Reflection\Types\Null_;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Coupon $coupons, CouponFilter $filters)
    {
        if(!request()->has('page')){
            request()->page=1;
        }
        $per_page=10;
        $coupons=$coupons->filter($filters)->orderByRaw('-user_id DESC, id asc')->paginate($per_page);


        return view('admin.coupon.index')->with([
            'coupons' => $coupons,
            'per_page' => $per_page

        ]);

    }


    public function getServices(Request $request){
        $subscription=Subscription::find($request->id);
        $service=$subscription->service;
        return view('admin.ajax.coupon_service',['service'=>$service])->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $periods=Period::all();
        return view('admin.coupon.create',['periods'=>$periods]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Faker $faker)
    {
        $request->validate([
            'count' => 'required|numeric',
            'code' => 'required|max:2|min:2',
            'period'=>'required',
            'type' => 'required',
        ]);
        if($request->period_id == 0) {
            $period = Null;
        }
        else{
            $period = $request->period_id;
        }
        for ($a = 0; $a < $request->count; $a++) {
            factory(Coupon::class, 1)->create([
                'coupon' => strtoupper($faker->unique()->bothify($request->code . '********')),
                'is_active' => 1,
                'status' => 0,
                'period_id'=>$period,
                'type' => $request->type,
            ]);
        }
        return redirect()->route('coupon.index')->with('success', 'Coupons Added');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
