<?php

namespace App\Actions\Province;

use App\Data\ProvinceData;
use App\Models\Province;

class GetProvince
{

    public function handle(int $id): ?ProvinceData
    {
        return Province::find($id)?->getData();
    }

    public function __invoke(int $id)
    {
        return $this->handle($id);
    }
}
