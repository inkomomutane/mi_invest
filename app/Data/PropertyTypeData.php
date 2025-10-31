<?php

namespace App\Data;

use App\Models\PropertyType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;

/** @typescript */
class PropertyTypeData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public Lazy|MediaData $icon,
    ) {
    }

    public static function fromModel(PropertyType $propertyType): PropertyTypeData
    {
        return new self(
            id: $propertyType->id,
            name: $propertyType->name,
            icon: Lazy::whenLoaded('media', $propertyType, fn () => MediaData::fromModel($propertyType->getFirstMedia('icons')))
        );
    }
}
