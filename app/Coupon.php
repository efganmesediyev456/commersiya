<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\LaravelFilterable\Filterable;

class Coupon extends Model
{
    use Filterable;
    protected $table = 'coupons';
    protected $fillable = [
        'user_id', 'coupon', 'is_active', 'status', 'type'
    ];
    const Trial=2;
    const FullCoupon=1;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function period()
    {
        return $this->belongsTo(Period::class, 'period_id','id');
    }
    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'subscription_id','id');
    }
}
