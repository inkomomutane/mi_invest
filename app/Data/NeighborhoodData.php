<?php

namespace App\Data;

use App\Models\Neighborhood;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;

/** @typescript */
class NeighborhoodData extends Data
{
    public function __construct(
        public ?int $id,
        public string $name,
        public Lazy|null|CityData $city
    ) {
    }

    public static function fromModel(Neighborhood $neighborhood)
    {
        return new self(
            id: $neighborhood->id,
            name: $neighborhood->name,
            city: Lazy::whenLoaded('city', $neighborhood, fn () => $neighborhood->city->getData())
        );
    }
}
