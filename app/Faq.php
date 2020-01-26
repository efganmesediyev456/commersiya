<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Faq extends Model
{
    use HasTranslations;
    protected $fillable = [
      'question','answer','is_active'
    ];
    protected $table = 'faq';
    public $translatable = ['question','answer'];
    public $timestamps = true;

}
