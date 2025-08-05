<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Pricecurrent\LaravelEloquentFilters\AbstractEloquentFilter;

class PropertyNeighborhoodFilter extends AbstractEloquentFilter
{
    /** @var array<int> neighborhoods */
    protected array $neighborhoods;

    public function __construct(array $neighborhoods = [])
    {
        $this->neighborhoods = $neighborhoods;
    }

    public function apply(Builder $query): Builder
    {
        return $query->whereIn('neighborhood_id', $this->neighborhoods);
    }
}
