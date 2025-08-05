<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Pricecurrent\LaravelEloquentFilters\AbstractEloquentFilter;

class PropertyConditionFilter extends AbstractEloquentFilter
{
    /** @var array<int> conditions */
    protected array $conditions;

    public function __construct(array $conditions = [])
    {
        $this->conditions = $conditions;
    }

    public function apply(Builder $query): Builder
    {
        return $query->whereIn('condition_id', $this->conditions);
    }
}
