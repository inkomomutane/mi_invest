<?php

namespace App\Actions\Property;

use App\Data\BusinessRuleData;
use App\Data\ConditionData;
use App\Data\IntermediationRuleData;
use App\Data\MultilevelProvinceData;
use App\Data\PropertyPurposeData;
use App\Data\PropertyTypeData;
use App\Data\StatusData;
use App\Models\BusinessRule;
use App\Models\Condition;
use App\Models\IntermediationRule;
use App\Models\PropertyPurpose;
use App\Models\PropertyType;
use App\Models\Province;
use App\Models\Status;
use Inertia\Inertia;

class CreateProperty
{

    public function __invoke()
    {
        return Inertia::render('Property/CreateProperty', [
            'regrasDeBusinessRule' => BusinessRuleData::collect(BusinessRule::all()),
            'transactionTypes' => PropertyPurposeData::collect(PropertyPurpose::all()),
            'provinces' => MultilevelProvinceData::collect(Province::with('cities.neighborhoods')->get()),
            'propertiesTypes' => PropertyTypeData::collect(PropertyType::all()),
            'propertyConditions' => ConditionData::collect(Condition::all()),
            'statuses' => StatusData::collect(Status::all()),
            'intermediationRules' => IntermediationRuleData::collect(IntermediationRule::all()),
        ]);
    }
}
