<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Data;

/** @typescript */
class BusinessRuleData extends Data
{
    public function __construct(
        public readonly ?int $id,
        #[Unique('business_rules','name')]
        public readonly ?string $name,
    ) {
    }
}
