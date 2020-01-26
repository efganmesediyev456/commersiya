<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class About extends Model
{
    use HasTranslations;
    protected $table='about';
    protected $fillable = [
        'content','key'
    ];
    public $timestamps=false;
    public $translatable = ['content'];

}
