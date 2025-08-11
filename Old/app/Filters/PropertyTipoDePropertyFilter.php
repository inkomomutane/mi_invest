<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Pricecurrent\LaravelEloquentFilters\AbstractEloquentFilter;

class PropertyTipoDePropertyFilter extends AbstractEloquentFilter
{
    /** @var array<int> tiposDeProperty */
    protected array $tiposDeProperty;

    public function __construct(array $tiposDeProperty = [])
    {
        $this->tiposDeProperty = $tiposDeProperty;
    }

    public function apply(Builder $query): Builder
    {
        return $query->whereIn('tipo_de_property_id', $this->tiposDeProperty);
    }
}
