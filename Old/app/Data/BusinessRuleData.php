<?php

namespace App\Data;

use Spatie\LaravelData\Data;

/** @typescript */
class BusinessRuleData extends Data
{
    public function __construct(
        public readonly ?int $id,
        public readonly ?string $name,
    ) {
    }
}
