<?php

namespace App\Data;

use Spatie\LaravelData\Data;
/** @typescript */
class IconData extends Data
{
    public function __construct(
        public ?int $id ,
        public readonly string $title,
        public readonly array $tags,
        public readonly array $categories,
        public readonly ?bool $lab = false,
    ) {}
}
