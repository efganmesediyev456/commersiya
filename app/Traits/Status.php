<?php
namespace App\Traits;

trait Status
{
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeFree($query)
    {
        return $query->where('status', 0);
    }
}
