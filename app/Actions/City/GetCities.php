<?php

namespace App\Actions\City;

use App\Data\CityData;
use App\Data\ProvinceData;
use App\Models\City;
use App\Models\Province;
use Inertia\Inertia;

class GetCities
{

    public function handle(?string $term = null)
    {
        return CityData::collect(
            City::query()
                ->when($term, function ($query, $search) {
                    $query->where('nome', 'like', '%'.$search.'%');
                    $query->with('province');
                })->with('province')->
            orderBy('created_at', 'desc')->paginate(5)->withQueryString()
        );
    }

    public function __invoke(): \Inertia\Response
    {
        return Inertia::render('City/Index', [
            'cities' => $this->handle(request()->search),
            'provinces' => ProvinceData::collect(Province::all()),
        ]);
    }
}
