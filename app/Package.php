<?php

namespace App;

use App\Traits\Status;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Package extends Model
{
    use HasTranslations, Status;

    protected $fillable = [
        'name', 'price', 'ministra_id', 'is_active'
    ];

    public $translatable = ['name'];
    public $timestamps = true;

}
