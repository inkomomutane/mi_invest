<?php

namespace App\Actions\PropertyPurpose;

use App\Data\PropertyPurposeData;
use App\Models\PropertyPurpose;
use Spatie\LaravelData\Exceptions\InvalidDataClass;

class GetPropertyPurpose
{

    /**
     * @throws InvalidDataClass
     */
    public function handle(int $id): ?PropertyPurposeData
    {
        return PropertyPurpose::find($id)?->getData();
    }

    /**
     * @throws InvalidDataClass
     */
    public function __invoke(int $id): ?PropertyPurposeData
    {
        return $this->handle($id);
    }
}