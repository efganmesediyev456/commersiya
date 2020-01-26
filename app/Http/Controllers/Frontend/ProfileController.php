<?php

namespace App\Http\Controllers\Frontend;

use App\About;
use App\Components\GoldenpayUtils;
use App\Coupon;
use App\Http\Controllers\Controller;
use App\License;
use App\MinistraClient;
use App\Payment;
use App\Period;
use App\Service;
use App\Subscription;
use App\Tariff;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\URL;
use phpDocumentor\Reflection\Types\Void_;
use Illuminate\Support\Facades\DB;


class ProfileController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        return view('frontend.profile.index', compact('user'));
    }

    public function subscribe($package_id)
    {

    }

    public function changepass(Request $request)
    {
        $this->validate($request, [
            'current' => 'required',
            'password' => 'required',
            'confirm' => 'required',
        ]);
        $user = Auth::user();
        if (password_verify($request->current, $user->password)) {
            if ($request->password == $request->confirm) {
                $password = Hash::make($request->password);
                $user->password = $password;
                if ($user->save()) {
                    return redirect()->route('profile')->with('success', 'Password successfully changed');
                } else {
                    return redirect()->back()->withInput()->with('error', 'Something went wrong');
                }
            } else {
                return redirect()->back()->withInput()->with('error', 'Password don\'t match');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Password is not correct');
        }
    }

    public function serviceDetail(Request $request)
    {
        $subscription = Subscription::findOrFail($request->id);
        return view('frontend.profile.detailsAjax', compact('subscription'))->render();
    }

    public function searchCouponCode(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);
        try{
            DB::beginTransaction();
            $coupons = Coupon::where('status', 0)->where('coupon', $request->code)->first();
            if ($coupons) {
                if($coupons->type == 2) {
                    $subcriptions = Subscription::where('user_id', Auth::id())->where('tariff_id', 10)->first();
                    if ($subcriptions) {
                        return redirect()->back()->with('error', __('site.already use'));
                    }
                    else {
                        return $this->trial($coupons->id);
                    }
                }
                else{
                    $coupons->is_active = 0;
                    $coupons->status = 1;
                    $coupons->user_id=Auth::id();
                    $coupons->save();
                    $tariff = Tariff::first();
                    $period = $coupons->period;
                    //Payment Paid At
                    $now=Carbon::now();
                    $period_month=$period->month;
                    //subscription deadline
                    $deadline=$now->addMonths($period_month);
                    if ($period->id !=2 ) {
                        $tariff->price = $tariff->price -1;
                    }
                    // TODO check price for coupon code, optimal version
                    $amount = GoldenpayUtils::calculatePrice($tariff, $period);
                    $payload = [
                        'user_id' => Auth::id(),
                        'tariff_id' => $tariff->id,
                        'm_tariff_id' => $tariff->ministra_id,
                        'account_number' => Subscription::generateAccountNumber(),
                        'device' => 0,
                        'period' => $period->id,
                        'mac_address' => null,
                        'amount' => $amount,
                        'payment_status' => 1,
                        'status' => 0,
                        'deadline'=>$deadline
                    ];
                    $subscription = Subscription::create($payload);

                    $coupons->subscription_id=$subscription->id;
                    $coupons->save();

                    if ($subscription->device == 0) {
                        $license = License::where('status',0)->first();
                    }
                    $expire_date = date_format(Carbon::now()->addMonth($subscription->month->month), 'Y-m-d H:i:s');
                    $payload = [
                        'password' => $subscription->account_number,
                        'full_name' => $subscription->user->name,
                        'user_id' => $subscription->user->id,
                        'login' => $subscription->account_number,
                        'account_number' => $subscription->account_number,
                        'tariff_plan' => $subscription->m_tariff_id,
                        'stb_mac' => $subscription->mac_address,
                        'status' => 1,
                        'license' => $subscription->device == 0 ? $license->license : '',
                        'end_date' => $expire_date,
                    ];
                    // TODO
                    $client = new MinistraClient();
                    $result = $client->postData('accounts', $payload);
//          if ($result->status == 'OK') {
                    if ($result->status == 'OK') {
                        $subscription->payment_status = 1;
                        $subscription->status = 1;
                        $subscription->save();
                        if ($subscription->device == 0) {
                            $license->status = 1;
                            $license->subscribe_id = $subscription->id;
                            $license->user_id = $subscription->user->id;
                            $license->save();
                        }
                        $service = Service::create($payload);
                        $paymentPayload = [
                            'user_id' => $subscription->user->id,
                            'subscription_id' => $subscription->id,
                            'type' => Payment::COUPON,
                            'period_id' => $subscription->period,
                            'amount' => $subscription->amount,
                            'status' => 1,
                            'paid_at' => $now
                        ];
                        $payment = Payment::create($paymentPayload);
                        DB::commit();
                        return redirect()->route('profile.connect_via_sub',['id'=>$subscription])->with('success',__('site.successfully'));
                    }
                }
            } else {
                return redirect()->back()->withErrors(__('site.notfound'));
            }
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(__('site.wrong'));
        }
    }

    public function trial($id)
    {
        $coupons = Coupon::find($id);
        $coupons->is_active = 0;
        $coupons->status = 1;
        $coupons->user_id = Auth::id();
        $coupons->save();
        $tariff = Tariff::where('id', 10)->first();//Payment Paid At
        $now = Carbon::now();
        $period_days = 7;
        //subscription deadline
        $deadline = $now->addDays($period_days);

        $payload = [
            'user_id' => Auth::id(),
            'tariff_id' => $tariff->id,
            'm_tariff_id' => $tariff->ministra_id,
            'account_number' => Subscription::generateAccountNumber(),
            'device' => 0,
            'mac_address' => null,
            'amount' => 0,
            'payment_status' => 1,
            'status' => 0,
            'deadline' => $deadline
        ];

        $subscription = Subscription::create($payload);
        $coupons->subscription_id = $subscription->id;
        $coupons->save();
        if ($subscription->device == 0) {
            $license = License::where('status', 0)->first();
        }
        $expire_date = date_format(Carbon::now()->addDays(7), 'Y-m-d H:i:s');
        $payload = [
            'password' => $subscription->account_number,
            'full_name' => $subscription->user->name,
            'user_id' => $subscription->user->id,
            'login' => $subscription->account_number,
            'account_number' => $subscription->account_number,
            'tariff_plan' => $subscription->m_tariff_id,
            'stb_mac' => $subscription->mac_address,
            'status' => 1,
            'license' => $subscription->device == 0 ? $license->license : '',
            'end_date' => $expire_date,
        ];

        $client = new MinistraClient();
        $result = $client->postData('accounts', $payload);
        if ($result->status == 'OK') {
            $subscription->payment_status = 1;
            $subscription->status = 1;
            $subscription->save();
            if ($subscription->device == 0) {
                $license->status = 1;
                $license->subscribe_id = $subscription->id;
                $license->user_id = $subscription->user->id;
                $license->save();
            }
            $service = Service::create($payload);
            $paymentPayload = [
                'user_id' => $subscription->user->id,
                'subscription_id' => $subscription->id,
                'type' => Payment::COUPON,
                'period_id' => $subscription->period,
                'amount' => $subscription->amount,
                'status' => 1,
                'paid_at' => $now
            ];
            $payment = Payment::create($paymentPayload);
            DB::commit();
            return redirect()->route('profile.connect_via_sub', ['id' => $subscription])->with('success', __('site.successfully'));
        }
        else{
            return 'something went wrong';
        }
    }


    public function connect()
    {
        $content = About::where('key','connect')->first();
        return view('how-to-connect', compact('content'));
    }

    public function connectSubscribe(Request $request)
    {
        $subscription = Subscription::findOrFail($request->id);
        $user = new User();
        if($user->checkUserSubscribe($subscription->user_id)) {
            $content = About::where('key', 'connect_via_subscribe')->first();
            return view('connect-via-subscribe', compact('subscription', 'content'));
        }
        else {
            return redirect()->route('profile.connect');
        }

    }
}
