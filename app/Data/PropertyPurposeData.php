<?php

namespace App\Data;

use Spatie\LaravelData\Data;

/** @typescript */
class PropertyPurposeData extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $slug_text,
        public readonly ?int $id = null,
    ) {
    }
}
