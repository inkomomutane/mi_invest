<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Pricecurrent\LaravelEloquentFilters\AbstractEloquentFilter;

class PropertyPropertyForFilter extends AbstractEloquentFilter
{
    /** @var array<int> propertiesFor */
    protected array $propertiesFor;

    public function __construct(array $propertiesFor = [])
    {
        $this->propertiesFor = $propertiesFor;
    }

    public function apply(Builder $query): Builder
    {
        return $query->whereIn('property_for_id', $this->propertiesFor);
    }
}
