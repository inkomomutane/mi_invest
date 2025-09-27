<?php

namespace App\Actions\Property;

use App\Models\Property;
use Pricecurrent\LaravelEloquentFilters\EloquentFilters;

class FilteredProperty
{public function handle(EloquentFilters $filters)
    {
        return Property::filter($filters)
            ->withApproved()
            ->with(
                [
                    'corretor',
                    'condition',
                    'status',
                    'businessRule',
                    'tipo_de_property',
                    'propertyFor',
                    'neighborhood.city.province',
                    'intermediationRule',
                    'media',
                ]
            );
    }
}
