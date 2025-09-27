<?php

namespace App\Actions\City;

use App\Models\City;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CreateCity
{

    public function handle(array $city): City
    {
        return City::create($city);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:cities,name',
            'province_id' => 'required|exists:provinces,id',
        ];
    }

    public function __invoke(Request $request): RedirectResponse
    {
        $this->handle($request->validate($this->rules()));
        flash()->addSuccess(__('messages.city_created_success'));

        return \redirect()->back();
    }
}
