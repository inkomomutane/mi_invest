<?php

namespace App\Actions\Hotel;

use App\Data\AttributeData;
use App\Data\ConditionData;
use App\Data\PropertyTypeData;
use App\Data\MultilevelProvinceData;
use App\Data\StatusData;
use App\Models\Attribute;
use App\Models\Condition;
use App\Models\Province;
use App\Models\Status;
use App\Models\PropertyType;
use Inertia\Inertia;

class CreateHotel
{

    public function __invoke(): \Inertia\Response
    {
        return Inertia::render('Hotel/CreateHotel', [
            'provinces' => MultilevelProvinceData::collect(Province::with('cities.neighborhoods')->get()),
            'propertiesTypes' => PropertyTypeData::collect(PropertyType::all()),
            'propertyConditions' => ConditionData::collect(Condition::all()),
            'statuses' => StatusData::collect(Status::all()),
            'attributes' => AttributeData::collect(Attribute::with('media')->get()),
        ]);
    }
}
