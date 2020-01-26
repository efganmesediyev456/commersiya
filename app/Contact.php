<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name','email','message','phone'
    ];
    protected $table='contact';
    public $timestamps=true;

}
