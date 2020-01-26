<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Tariff extends Model
{
    use HasTranslations;

    protected $table = 'tariffs';

    protected $fillable = [
        'name', 'ministra_id', 'type', 'price', 'detail', 'icon'
    ];

    public $translatable = ['name'];

    public $timestamps = true;

    public function default()
    {
        return $this->belongsToMany(Package::class,'tariff_default')->withPivot('tariff_id','package_id');
    }
}
