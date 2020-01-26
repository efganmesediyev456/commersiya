<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Kyslik\LaravelFilterable\Filterable;

class Subscription extends Model
{
    use Filterable;
    protected $table = 'subscription';

    protected $fillable = [
        'user_id', 'package_id', 'tariff_id', 'm_tariff_id', 'account_number', 'payment_status', 'status',
        'device', 'period', 'mac_address', 'amount', 'deadline'
    ];

    public static function generateAccountNumber()
    {
        return mt_rand(10000000, 99999999);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->hasOne(Package::class, 'id', 'package_id');
    }

    public function service()
    {
        return $this->hasOne(Service::class, 'account_number', 'account_number');
    }

    public function month()
    {
        return $this->hasOne(Period::class, 'id', 'period');
    }

    public function tariff()
    {
        return $this->hasOne(Tariff::class, 'id', 'tariff_id');
    }

    public function license()
    {
        return $this->hasOne(License::class, 'subscribe_id', 'id');
    }

    public function scopeFilterByDate($query, $from, $to)
    {
        $query->whereBetween('created_at', [$from, $to]);
        return $query;
    }

    public function scopeFilterByColumn($query, $column, $value)
    {
        $query->where($column, $value);
        return $query;
    }
}
