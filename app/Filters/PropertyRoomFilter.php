<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Pricecurrent\LaravelEloquentFilters\AbstractEloquentFilter;

class PropertyRoomFilter extends AbstractEloquentFilter
{
    protected int $rooms;

    public function __construct(int $rooms)
    {
        $this->rooms = $rooms;
    }

    public function apply(Builder $query): Builder
    {
        return $query->where('quartos', '<=', $this->rooms);
    }
}
