<?php

namespace App\Actions\PropertyType;

use App\Data\PropertyTypeData;
use App\Models\PropertyType;
use Illuminate\Contracts\Pagination\Paginator;
use Inertia\Inertia;

class GetPropertyTypes
{

    public function handle(?string $term = null): Paginator|array|\Illuminate\Support\Enumerable|\Illuminate\Support\Collection|\Spatie\LaravelData\PaginatedDataCollection|\Spatie\LaravelData\CursorPaginatedDataCollection|\Illuminate\Pagination\AbstractCursorPaginator|\Illuminate\Support\LazyCollection|\Spatie\LaravelData\DataCollection|\Illuminate\Pagination\AbstractPaginator|\Illuminate\Contracts\Pagination\CursorPaginator
    {
        return PropertyTypeData::collect(
            PropertyType::query()
                ->when($term, function ($query, $search) {
                    $query->whereAny([
                        'name',
                    ], 'like', '%'.$search.'%');
                })->with('media')->
            orderBy('created_at', 'desc')->paginate(5)->withQueryString()
        );
    }

    public function __invoke(): \Inertia\Response
    {
        return Inertia::render('PropertyType/Index', [
            'propertyTypes' => $this->handle(request()->search),
        ]);
    }
}
