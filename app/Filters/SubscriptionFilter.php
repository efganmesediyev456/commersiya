<?php

namespace App\Filters;

use Kyslik\LaravelFilterable\Filter;

class SubscriptionFilter extends Filter
{
    /**
     * Available Filters and their aliases.
     *
     * @return array ex: ['method-name', 'another-method' => 'alias', 'yet-another-method' => ['alias-one', 'alias-two]]
     */
    public function filterMap(): array
    {
        return [
            'paymentStatusFilter'=>['payment_status'],
            'createdAtFilter'=>['to','from'],
            'statusFilter'=>['status'],
            'tariffFilter'=>['tariff_id'],
            'deviceFilter'=>['device']
        ];
    }


    public function paymentStatusFilter($payment_status = null)
    {

        if (isset($payment_status)) {
            return $this->builder->where('payment_status', '=', $payment_status);
        }
        return $this->builder;
    }
    public function statusFilter($status = null)
    {
        if (isset($status)) {
            return $this->builder->where('status', '=', $status);
        }
        return $this->builder;
    }
    public function tariffFilter($tariff_id = null)
    {
        if (isset($tariff_id)) {
            return $this->builder->where('tariff_id', '=', $tariff_id);
        }
        return $this->builder;
    }
    public function deviceFilter($device = null)
    {
        if (isset($device)) {
            return $this->builder->where('device', '=', $device);
        }
        return $this->builder;
    }
    public function createdAtFilter($to = null)
    {
        $date_to=$to[0];
        $date_from=$to[1];
        if (isset($date_to) and isset($date_from)) {
            return $this->builder->whereBetween('created_at', [(new \carbon\Carbon($date_to))->toDateTimeString(), (new \carbon\Carbon($date_from))->toDateTimeString()] );
        }
        return $this->builder;



    }
}
