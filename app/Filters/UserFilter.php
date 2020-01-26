<?php

namespace App\Filters;

use Carbon\Carbon;
use Kyslik\LaravelFilterable\Filter;

class UserFilter extends Filter
{
    /**
     * Available Filters and their aliases.
     *
     * @return array ex: ['method-name', 'another-method' => 'alias', 'yet-another-method' => ['alias-one', 'alias-two]]
     */

    public function filterMap(): array
    {
        return ['statusFilter'=>['status'],'createdAtFilter'=>['to','from']];
    }


    public function statusFilter($status = null)
    {
        if (isset($status)) {
            return $this->builder->where('type', '=', $status);
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
