<?php

namespace App\Data;

use Spatie\LaravelData\Data;

/** @typescript */
class TermData extends Data
{
    public function __construct(
        public ?int $id,
        public readonly ?string $terms,
        public readonly ?string $term
    ) {
    }
}
