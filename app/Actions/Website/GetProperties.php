<?php

namespace App\Actions\Website;

use App\Actions\Property\FilteredProperty;
use App\Data\NeighborhoodData;
use App\Data\PropertyData;
use App\Data\PropertyTypeData;
use App\Data\RequestFiltersData;
use App\Filters\PropertyNeighborhoodFilter;
use App\Filters\PropertyTipoDePropertyFilter;
use App\Filters\PropertyTitleFilter;
use App\Models\Neighborhood;
use App\Models\PropertyType;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use Illuminate\Http\Request;

use Pricecurrent\LaravelEloquentFilters\AbstractEloquentFilter;
use Pricecurrent\LaravelEloquentFilters\EloquentFilters;

class GetProperties
{

    public function handle(Request $actionRequest)
    {
        return PropertyData::collect(FilteredProperty::run(
            EloquentFilters::make($this->FiltersBinder($actionRequest))
        )->paginate(12)->withQueryString());
    }

    public function __invoke(Request $actionRequest)
    {
        return Inertia::render('Website/Properties', [
            'properties' => $this->handle($actionRequest),
            'propertyTypes' => PropertyTypeData::collect(PropertyType::all()),
            'neighborhoods' => NeighborhoodData::collect(Neighborhood::all()),
            'filters' => new RequestFiltersData(
                propertyTypes: collect($actionRequest->property_types)->map(fn ($number) => (int) $number)->toArray(),
                title: $actionRequest->title,
                neighborhoods: collect($actionRequest->neighborhoods)->map(fn ($number) => (int) $number)->toArray(),
            ),
        ]);
    }

    private function FiltersBinder(Request $actionRequest): array
    {
        /** @var Collection<AbstractEloquentFilter> filters */
        $filters = collect([]);
        if (! is_null($actionRequest->property_types) && is_array($actionRequest->property_types) && count($actionRequest->property_types) > 0) {
            $filters = $filters->push(new PropertyTipoDePropertyFilter($actionRequest->property_types));
        }

        if (! is_null($actionRequest->neighborhoods) && is_array($actionRequest->neighborhoods) && count($actionRequest->neighborhoods) > 0) {
            $filters = $filters->push(new PropertyNeighborhoodFilter($actionRequest->neighborhoods));
        }

        if (! is_null($actionRequest->title) && is_string($actionRequest->title)) {
            $filters = $filters->push(new PropertyTitleFilter($actionRequest->title));
        }

        return $filters->toArray();
    }
}
