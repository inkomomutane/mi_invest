<?php

namespace App\Actions\Province;

use App\Data\ProvinceData;
use App\Models\Province;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CreateProvince
{

    public function handle(ProvinceData $province): Province
    {
        return Province::create($province->all());
    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:provinces,name',
        ];
    }

    public function __invoke(Request $request): RedirectResponse
    {
        $this->handle(ProvinceData::from($request->validate($this->rules())));
        flash()->addSuccess(__('messages.province_created_success'));
        return \redirect()->back();
    }
}
