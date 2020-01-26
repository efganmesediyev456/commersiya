<?php

namespace App\Filters;

use Kyslik\LaravelFilterable\Filter;

class CouponFilter extends Filter
{
    /**
     * Available Filters and their aliases.
     *
     * @return array ex: ['method-name', 'another-method' => 'alias', 'yet-another-method' => ['alias-one', 'alias-two]]
     */
    function filterMap(): array
    {
        return [
            'couponNameFilter'=>['coupon'],
        ];
    }

    public function couponNameFilter($coupon = null)
    {

        if (isset($coupon)) {
            return $this->builder->where('coupon', 'like', '%'.$coupon.'%');
        }
        return $this->builder;
    }
}
