<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Subscription;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MillionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->command == 'check') {
            $subscription = \App\Subscription::where('account_number', $request->account)->first();
            if ($subscription) {
                $user = $subscription->user;
                $payload = [
                    'subscription_id' => $subscription->id,
                    'type' => 2,
                    'payment_details' => $request->txn_id,
                    'status' => 0,
                    'user_id' => $user->id,
                ];
                $payment = new \App\Payment($payload);
                $payment->save();
                $user = User::find($payment->user_id);
                if ($user) {
                    $check = True;
                } else {
                    $check = False;
                    $user = False;
                }
            } else {
                $check = False;
                $user = False;
            }
            return \Response::view('million.check', ['user' => $user, 'osmp_txn_id' => $request->txn_id, 'check' => $check])->header('Content-Type', 'xml');
        }

        if ($request->command == 'pay') {
            $payment = Payment::where('payment_details', $request->txn_id)->first();

            $payment->amount = $request->sum;
            $payment->paid_at = $request->txn_date;
            $payment->status = 1;
            $payment->save();
            $subscription = Subscription::where('account_number', $request->account)->first();
            $user = User::find($subscription->user_id);


            $price = $subscription->tariff->price;

            if (($request->sum + $user->remainder) >= $price) {
                $count_months = intdiv(($request->sum + $user->remainder), $price);
                $remainder = fmod(($request->sum + $user->remainder), $price);

                if ($count_months > 0) {

                    if ($subscription->deadline) {
                        if (Carbon::now() > $subscription->deadline) {
                            $deadline = Carbon::parse($payment->paid_at)->addMonth($count_months);
                        } else {
                            $deadline = Carbon::parse($subscription->deadline)->addMonth($count_months);
                        }
                    } else {
                        $deadline = Carbon::parse($payment->paid_at)->addMonth($count_months);
                    }
                    $subscription->deadline = $deadline;
                    $subscription->status = 1;
                    $subscription->payment_status = 1;
                    $subscription->save();
                }

            } else {
                $count_months = 0;
                $remainder = $request->sum + $user->remainder;
            }
            $user->remainder = $remainder;
            $user->save();

            return \Response::view('million.pay', ['txn_id' => $request->txn_id, 'amount' => $request->sum])->header('Content-Type', 'xml');

        }


        if ($request->command == 'status') {
            $payment = Payment::where('payment_details', $request->txn_id)->first();
            if ($payment->status) {
                $status = 1;
            } else {
                $status = 0;
            }
            return \Response::view('million.status', ['status' => $status, 'txn_id' => $request->txn_id])->header('Content-Type', 'xml');

        }
    }
}
