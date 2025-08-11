<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Pricecurrent\LaravelEloquentFilters\AbstractEloquentFilter;

class PropertyTitleFilter extends AbstractEloquentFilter
{
    protected string $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function apply(Builder $query): Builder
    {
        return $query->where('titulo', 'like', "%{$this->title}%")
            ->orWhere('descricao', 'like', "%{$this->title}%")
            ->orWhere('endereco', 'like', "%{$this->title}%")
            ->orWhereRelation('neighborhood', 'nome', 'like', "%{$this->title}%")
            ->orWhereRelation('neighborhood.city', 'nome', 'like', "%{$this->title}%")
            ->orWhereRelation('neighborhood.city.province', 'name', 'like', "%{$this->title}%");
    }
}
