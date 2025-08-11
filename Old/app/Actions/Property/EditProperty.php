<?php

namespace App\Actions\Property;

use App\Data\ConditionData;
use App\Data\PropertyTypeData;
use App\Data\IntermediationRuleData;
use App\Data\MultilevelProvinceData;
use App\Data\BusinessRuleData;
use App\Data\StatusData;
use App\Data\PropertyPurposeData;
use App\Models\Condition;
use App\Models\Property;
use App\Models\PropertyPurpose;
use App\Models\IntermediationRule;
use App\Models\Province;
use App\Models\BusinessRule;
use App\Models\Status;
use App\Models\PropertyType;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Inertia\Inertia;

class EditProperty
{

    public function __invoke(Property $property)
    {

        $property = $property->load([
            'broker',
            'businessRule',
            'intermediationRule',
            'neighborhood.city.province',
            'condition',
            'propertyType',
            'status',
            'propertyPurpose',
            'media' => function (MorphMany $query) {
                $query->where('collection_name', 'images');
            },
        ]);

        return Inertia::render('Property/EditProperty', [
            'property' => $property->getData(),
            'businessRules' => BusinessRuleData::collect(BusinessRule::all()),
            'propertyPurposes' => PropertyPurposeData::collect(PropertyPurpose::all()),
            'provinces' => MultilevelProvinceData::collect(Province::with('cities.neighborhoods')->get()),
            'propertyTypes' => PropertyTypeData::collect(PropertyType::all()),
            'propertyConditions' => ConditionData::collect(Condition::all()),
            'statuses' => StatusData::collect(Status::all()),
            'intermediationRules' => IntermediationRuleData::collect(IntermediationRule::all()),
        ]);
    }
}
