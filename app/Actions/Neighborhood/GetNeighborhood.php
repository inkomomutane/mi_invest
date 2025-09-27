<?php

namespace App\Actions\Neighborhood;

use App\Data\NeighborhoodData;
use App\Models\Neighborhood;
use Spatie\LaravelData\Exceptions\InvalidDataClass;

class GetNeighborhood
{

    /**
     * @throws InvalidDataClass
     */
    public function handle(int $id): ?NeighborhoodData
    {
        return Neighborhood::find($id)?->getData();
    }

    /**
     * @throws InvalidDataClass
     */
    public function __invoke(int $id): ?NeighborhoodData
    {
        return $this->handle($id);
    }
}