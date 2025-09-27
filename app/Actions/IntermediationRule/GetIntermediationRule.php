<?php

namespace App\Actions\IntermediationRule;

use App\Data\IntermediationRuleData;
use App\Models\IntermediationRule;
use Spatie\LaravelData\Exceptions\InvalidDataClass;

class GetIntermediationRule
{

    /**
     * @throws InvalidDataClass
     */
    public function handle(int $id): ?IntermediationRuleData
    {
        return IntermediationRule::find($id)?->getData();
    }

    /**
     * @throws InvalidDataClass
     */
    public function __invoke(int $id): ?IntermediationRuleData
    {
        return $this->handle($id);
    }
}