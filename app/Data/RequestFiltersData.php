<?php

namespace App\Data;

use Spatie\LaravelData\Data;

/** @typescript **/
class RequestFiltersData extends Data
{
    public function __construct(
        /** @var null|int[] $propertyTypes */
        public ?array $propertyTypes,
        public ?string $title,
        public ?array $neighborhoods
    ) {
    }
}
