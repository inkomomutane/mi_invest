<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Pricecurrent\LaravelEloquentFilters\AbstractEloquentFilter;

class PropertyGarageFilter extends AbstractEloquentFilter
{
    protected int $garges;

    public function __construct(int $garges)
    {
        $this->garges = $garges;
    }

    public function apply(Builder $query): Builder
    {
        return $query->where('garagens', '<=', $this->garges);
    }
}
