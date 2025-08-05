<?php

namespace App\Data;

use Carbon\CarbonImmutable;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
/** @typescript */
class ScheduleData extends Data
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $clientName = '',
        public readonly ?string $message = '',
        public readonly ?string $email = '',
        public readonly ?string $contact = '',
        public readonly ?bool $isRead = null,
        #[WithCast(DateTimeInterfaceCast::class, type: CarbonImmutable::class)]
        public $dateTime = null,
        public readonly ?string $url = ''
    ) {
    }
}
