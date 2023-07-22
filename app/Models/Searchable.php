<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    public function scopeSearch(Builder $query, $term)
    {
        return $query->where('name', 'LIKE', "%$term%")
            ->orWhere('description', 'LIKE', "%$term%");
    }
}