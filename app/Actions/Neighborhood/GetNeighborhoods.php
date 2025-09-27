<?php

namespace App\Actions\Neighborhood;

use App\Data\CityData;
use App\Data\NeighborhoodData;
use App\Models\City;
use App\Models\Neighborhood;
use Illuminate\Contracts\Pagination\Paginator;
use Inertia\Inertia;

class GetNeighborhoods
{

    public function handle(?string $term = null): Paginator|array|\Illuminate\Support\Enumerable|\Illuminate\Support\Collection|\Spatie\LaravelData\PaginatedDataCollection|\Spatie\LaravelData\CursorPaginatedDataCollection|\Illuminate\Pagination\AbstractCursorPaginator|\Illuminate\Support\LazyCollection|\Spatie\LaravelData\DataCollection|\Illuminate\Pagination\AbstractPaginator|\Illuminate\Contracts\Pagination\CursorPaginator
    {
        return NeighborhoodData::collect(
            Neighborhood::query()
                ->when($term, function ($query, $search) {
                    $query->whereAny([
                        'name',
                    ], 'like', '%'.$search.'%');
                    $query->with('city');
                })->with('city')->
            orderBy('created_at', 'desc')->paginate(5)->withQueryString()
        );
    }

    public function __invoke(): \Inertia\Response
    {
        return Inertia::render('Neighborhood/Index', [
            'neighborhoods' => $this->handle(request()->search),
            'cities' => CityData::collect(City::all()),
        ]);
    }
}
