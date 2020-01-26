<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    const PERCENT = 'percent';
    const FIXED = 'fixed';

    protected $table='periods';

    protected $fillable=[
        'month','type','discount'
    ];

}
