<?php

namespace App\Actions\Status;

use App\Data\StatusData;
use App\Models\Status;
use Spatie\LaravelData\Exceptions\InvalidDataClass;

class GetStatus
{

    /**
     * @throws InvalidDataClass
     */
    public function handle(int $id): ?StatusData
    {
        return Status::find($id)?->getData();
    }

    /**
     * @throws InvalidDataClass
     */
    public function __invoke(int $id): ?StatusData
    {
        return $this->handle($id);
    }
}