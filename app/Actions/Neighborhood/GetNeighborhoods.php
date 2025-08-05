<?php

namespace App\Actions\Neighborhood;

use App\Data\NeighborhoodData;
use App\Data\CityData;
use App\Models\Neighborhood;
use App\Models\City;
use Inertia\Inertia;

class GetNeighborhoods
{

    public function handle(?string $term = null)
    {

        $neighborhoods = Neighborhood::query()
            ->when($term, function ($query, $search) {
                $query->where('name', 'like', '%'.$search.'%');
                $query->with('city');
            })->with('city')->
       orderBy('created_at', 'desc')->paginate(5)->withQueryString();

        return NeighborhoodData::collect(
            $neighborhoods
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
