<?php

namespace App\Actions\PropertyType;

use App\Data\PropertyTypeData;
use App\Models\PropertyType;
use Spatie\LaravelData\Exceptions\InvalidDataClass;

class GetPropertyType
{

    /**
     * @throws InvalidDataClass
     */
    public function handle(int $id): ?PropertyTypeData
    {
        return PropertyType::find($id)?->getData();
    }

    /**
     * @throws InvalidDataClass
     */
    public function __invoke(int $id): ?PropertyTypeData
    {
        return $this->handle($id);
    }
}