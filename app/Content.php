<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Content extends Model
{
    use HasTranslations;
    protected $table='content';
    protected $fillable = [
        'icon','text','title'
    ];

    public $translatable = ['text','title'];

}
