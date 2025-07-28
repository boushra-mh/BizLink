<?php
namespace App\Traits;

trait HasFilters
{
    public function scopeFilterByName($query, $name)
    {
        return $query->when($name, fn($q) =>
            $q->where('name', 'like', "%$name%")
        );
    }

    public function scopeFilterByStatus($query, $status)
    {
        return $query->when($status !== null, fn($q) =>
            $q->where('status', $status)
        );
    }

    public function scopeFilterByRelation($query, $relation, $column, $value)
    {
        return $query->when($value, fn($q) =>
            $q->whereHas($relation, fn($r) => $r->where($column, $value))
        );
    }
}
