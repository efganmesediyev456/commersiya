<?php

namespace App;

use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    use HasTranslations;
    protected $fillable = [
        'price','quantity','image','category_id'
    ];
    protected $table = 'products';
    public $translatable = ['name','details'];
    public $timestamps = false;
}
