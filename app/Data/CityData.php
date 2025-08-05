<?php

namespace App\Data;

use App\Models\City;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Lazy;

/** @typescript */
class CityData extends Data
{
    public function __construct(
        public ?int $id,
        public string $name,
        public Lazy|ProvinceData|null $province,
        /** @var NeighborhoodData[] */
        public Lazy|null|DataCollection $neighborhoods
    ) {
    }

    public static function fromModel(City $city)
    {
        return new self(
            id: $city->id,
            name: $city->name,
            province: Lazy::whenLoaded(
                'province',
                $city,
                fn () => $city->province->getData()
            ),
            neighborhoods: Lazy::whenLoaded('neighborhoods', $city, fn () => NeighborhoodData::collect($city->neighborhoods))
        );
    }
}
