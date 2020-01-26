<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    const BE = 1;
    const KOMTEC = 2;
    const ONLINE = 3;
    const COUPON = 4;
    const TRIAL = 5;

    protected $fillable = [
        'user_id', 'subscription_id', 'type', 'period_id', 'amount', 'status',
        'payment_details'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id','user_id');
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class,'id', 'subscription_id');
    }

    public function period()
    {
        return $this->hasOne(Period::class,'id','period_id');
    }
}
