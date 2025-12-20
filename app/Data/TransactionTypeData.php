<?php

namespace App\Data;

use App\Models\TransactionType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;

/** @typescript */
class TransactionTypeData extends Data
{
    public function __construct(
        public ?int $id =null,
        public ?string $name = null,
        public ?string $prefix = null,
        public Lazy|MediaData $icon,
    ) {
    }

    public static function fromModel(TransactionType $transactionType): TransactionTypeData
    {
        return new self(
            id: $transactionType->id,
            name: $transactionType->name,
            prefix: $transactionType->prefix,
            icon: Lazy::whenLoaded('media', $transactionType, fn () => MediaData::fromModel($transactionType->getFirstMedia('icons')))
        );
    }
}
