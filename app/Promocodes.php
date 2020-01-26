<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promocodes extends Model
{
    protected $table='promocodes';
    public $timestamps=true;
    protected $fillable = [
        'code','is_active','status','discount','deadline'
    ];
    protected $primaryKey='id';
}
