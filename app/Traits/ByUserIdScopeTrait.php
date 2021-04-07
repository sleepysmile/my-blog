<?php


namespace App\Traits;


trait ByUserIdScopeTrait
{
    public function scopeByUserId($query, int $id)
    {
        return $query->where('created_by', $id);
    }
}
