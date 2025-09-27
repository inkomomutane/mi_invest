<?php

namespace App\Actions\Condition;

use App\Data\ConditionData;
use App\Models\Condition;
use Spatie\LaravelData\Exceptions\InvalidDataClass;

class GetCondition
{

    /**
     * @throws InvalidDataClass
     */
    public function handle(int $id): ?ConditionData
    {
        return Condition::find($id)?->getData();
    }

    /**
     * @throws InvalidDataClass
     */
    public function __invoke(int $id): ?ConditionData
    {
        return $this->handle($id);
    }
}