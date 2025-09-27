<?php

namespace App\Actions\Province;

use App\Data\ProvinceData;
use App\Models\Province;
use Spatie\LaravelData\Exceptions\InvalidDataClass;

class GetProvince
{

    /**
     * @throws InvalidDataClass
     */
    public function handle(int $id): ?ProvinceData
    {
        return Province::find($id)?->getData();
    }

    /**
     * @throws InvalidDataClass
     */
    public function __invoke(int $id): ?ProvinceData
    {
        return $this->handle($id);
    }
}
