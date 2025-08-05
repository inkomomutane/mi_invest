<?php

namespace App\Actions\Province;

use App\Data\ProvinceData;
use App\Models\Province;
use Illuminate\Http\Request;

class CreateProvince
{

    public function handle(ProvinceData $province)
    {
        return Province::create($province->all());
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:provinces,name',
        ];
    }

    public function __invoke(Request $request)
    {
        $this->handle(ProvinceData::from($request->validated()));
        flash()->addSuccess(__('messages.province_created_success'));

        return \redirect()->back();
    }
}
