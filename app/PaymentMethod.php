<?php

namespace App;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasTranslations;
    public $translatable = ['address','name'];
    protected $fillable=[
        'phone','job_date','map_link','address','image'
    ];
}
