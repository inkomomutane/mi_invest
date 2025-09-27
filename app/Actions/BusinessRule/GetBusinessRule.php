<?php

namespace App\Actions\BusinessRule;

use App\Data\BusinessRuleData;
use App\Models\BusinessRule;
use Spatie\LaravelData\Exceptions\InvalidDataClass;

class GetBusinessRule
{

    /**
     * @throws InvalidDataClass
     */
    public function handle(int $id): ?BusinessRuleData
    {
        return BusinessRule::find($id)?->getData();
    }

    /**
     * @throws InvalidDataClass
     */
    public function __invoke(int $id): ?BusinessRuleData
    {
        return $this->handle($id);
    }
}