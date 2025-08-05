<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Pricecurrent\LaravelEloquentFilters\AbstractEloquentFilter;

class PropertyBathroomFilter extends AbstractEloquentFilter
{
    protected int $bathrooms;

    public function __construct(int $bathrooms)
    {
        $this->bathrooms = $bathrooms;
    }

    public function apply(Builder $query): Builder
    {
        return $query->where('banheiros', '<=', $this->bathrooms);
    }
}
