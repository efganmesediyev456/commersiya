<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use \App\Traits\Status;

    protected $table= 'license' ;
    protected $fillable = [
        'license','user_id','is_active', 'status', 'subscribe_id'
    ];

    public $timestamps=true;

    public function User() {
        return $this->belongsTo(User::class);
    }

    public function Subscribe() {
        return $this->belongsTo(Subscription::class);
    }
}
