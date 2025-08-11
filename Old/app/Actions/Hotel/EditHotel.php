<?php

namespace App\Actions\Hotel;

use App\Data\AttributeData;
use App\Data\ConditionData;
use App\Data\PropertyTypeData;
use App\Data\MultilevelProvinceData;
use App\Data\StatusData;
use App\Models\Attribute;
use App\Models\Condition;
use App\Models\HotelMetaData;
use App\Models\Province;
use App\Models\Status;
use App\Models\PropertyType;
use Inertia\Inertia;
use Spatie\LaravelData\Exceptions\InvalidDataClass;

class EditHotel
{//

    /**
     * @throws InvalidDataClass
     */
    public function __invoke(HotelMetaData $hotel): \Inertia\Response
    {
        $hotel->loadMissing(['hotels.media', 'neighborhood.city.province', 'status', 'tipoDeProperty', 'condition', 'media','attributes']);

        return Inertia::render('Hotel/EditHotel', [
            'hotel' => $hotel->getData(),
            'provinces' => MultilevelProvinceData::collect(Province::with('cities.neighborhoods')->get()),
            'propertiesTypes' => PropertyTypeData::collect(PropertyType::all()),
            'propertyConditions' => ConditionData::collect(Condition::all()),
            'statuses' => StatusData::collect(Status::all()),
            'attributes' => AttributeData::collect(Attribute::with('media')->get()),
        ]);
    }
}
