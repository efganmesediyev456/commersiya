<?php
namespace App\Http\Controllers\Frontend;

use App\Components\GoldenpayUtils;
use App\Http\Controllers\Controller;
use App\License;
use App\MinistraClient;
use App\Package;
use App\Payment;
use App\Period;
use App\Service;
use App\Subscription;
use App\Tariff;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function subscribe($tariff_id)
    {
        $tariff = Tariff::findOrFail($tariff_id);
        $periods = Period::all();
        return view('frontend.order.subscribe', compact('tariff', 'periods'));
    }

    public function order(Request $request, $tariff_id)
    {
        $tariff = Tariff::findOrFail($tariff_id);
        if ($tariff->price == 0) {
            $subcriptions = Subscription::where('user_id', Auth::id())->where('tariff_id', 10)->first();
            if ($subcriptions) {
                return redirect()->back()->with('error', __('site.already use'));
            } else {
                $request->validate([
                    'device' => 'required|integer',
                ]);
                $payload = [
                    'user_id' => Auth::id(),
                    'tariff_id' => $tariff->id,
                    'm_tariff_id' => $tariff->ministra_id,
                    'account_number' => Subscription::generateAccountNumber(),
                    'device' => $request->device,
                    'mac_address' => $request->mac_address ?? $request->mac_address,
                    'amount' => 0,
                    'payment_status' => 1,
                    'status' => 1,
                    'deadline' => Carbon::now()->addDays(7)

                ];
                $subscription = Subscription::create($payload);
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
                        'type' => Payment::TRIAL,
                        'period_id' => $subscription->period,
                        'amount' => $subscription->amount,
                        'status' => 1,
                        'paid_at' => Carbon::now()
                    ];
                    $payment = Payment::create($paymentPayload);
                }
                return redirect()->route('profile.connect_via_sub', ['id' => $subscription])->with('success', __('site.successfully'));
            }
        }
        else {
            $request->validate([
                'device' => 'required|integer',
                'period' => 'required|integer',
            ]);
            $period = Period::findOrFail($request->period);
            $amount = GoldenpayUtils::calculatePrice($tariff, $period);

            $payload = [
                'user_id' => Auth::id(),
                'tariff_id' => $tariff->id,
                'm_tariff_id' => $tariff->ministra_id,
                'account_number' => Subscription::generateAccountNumber(),
                'device' => $request->device,
                'period' => $period->id,
                'mac_address' => $request->mac_address ?? $request->mac_address,
                'amount' => $amount,
                'payment_status' => 0,
                'status' => 0,
            ];
            $subscription = Subscription::create($payload);
            return $this->paymentPage($subscription->id);
        }
    }



//    public function trial(Request $request, $tariff_id)
//    {
//        $request->validate([
//            'device' => 'required|integer',
//        ]);
//        return 'ok';
//    }

    public function paymentPage($subscription_id)
    {
        $subscription = Subscription::findOrFail($subscription_id);
        return view('frontend.order.payment', compact('subscription'));
    }

    public function pay($subscription_id)
    {
        $subscription = Subscription::findOrFail($subscription_id);
        return $this->payOrder($subscription);
    }

    protected function payOrder(Subscription $subscription)
    {
        // there is will be redirecting to Goldenpay
//        $price = $subscription->amount;
//        $card_type = 'v';
//        $payment = GoldenpayUtils::pay($price, $card_type, $subscription->id);
//        dd($payment);
        $payment =  $this->paymentResult($subscription->id);
        if ($payment){
            return redirect()->route('profile');
        }
    }

    public function paymentResult($subscription_id)
    {
        // there is will be post id from Goldepay
        $subscription = Subscription::findOrFail($subscription_id);
        if ($subscription->device == 0) {
            $license = License::get()->first();
        }
        $expire_date = date_format(Carbon::now()->addMonth($subscription->month->month), 'Y-m-d H:i:s');
        $client = new MinistraClient();
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
                'user_id' => $subscription->id,
                'subscription_id' => $subscription->id,
                'type' => Payment::ONLINE,
                'period_id' => $subscription->period,
                'amount' => $subscription->amount,
                'status' => 1,
                'paid_at' => Carbon::now()
            ];
            $payment = Payment::create($paymentPayload);
            return True;
        }

        return False;
    }


    public function selectPackage($tariff_id)
    {
        $tariff = Tariff::with('default')->findOrFail($tariff_id);
        $default = $tariff->default()->pluck('ministra_id')->toArray();
        $packages = Package::all();
        $periods = Period::all();
        return view('frontend.order.select-package', compact('packages', 'tariff', 'periods', 'default'));
    }

    public function mergePackage(Request $request, $tariff_id)
    {
        $tariff = Tariff::with('default')->findOrFail($tariff_id);
        $request->validate([
            'device' => 'required|integer',
            'period' => 'required|integer',
        ]);
        $package_ids = $tariff->default()->pluck('ministra_id')->toArray();
        $package_ids[] = $request->package;

        $client = new MinistraClient();
        $m_tariff_id = $client->getTariff($package_ids);

        if ($m_tariff_id) {
            $period = Period::findOrFail($request->period);
            $amount = GoldenpayUtils::calculatePrice($tariff, $period);

            $payload = [
                'user_id' => Auth::id(),
                'tariff_id' => $tariff->id,
                'm_tariff_id' => $m_tariff_id,
                'account_number' => Subscription::generateAccountNumber(),
                'device' => $request->device,
                'period' => $period->id,
                'mac_address' => $request->mac_address ?? $request->mac_address,
                'amount' => $amount,
                'payment_status' => 0,
                'status' => 0,
            ];
            $subscription = Subscription::create($payload);

            return $this->paymentPage($subscription->id);
        }

        return redirect()->route('frontend.select-package', $tariff_id)->with('error', "Something went't wrong. Please try again");
    }

}
