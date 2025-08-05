<?php

namespace App\Actions\City;

use App\Models\City;
use Illuminate\Http\Request;

class CreateCity
{

    public function handle(array $city)
    {
        return City::create($city);
    }

    public function rules()
    {
        return [
            'nome' => 'required|unique:cities,nome',
            'province_id' => 'required|numeric',
        ];
    }

    public function __invoke(Request $request)
    {
        $this->handle($request->validated());
        flash()->addSuccess(__('messages.city_created_success'));

        return \redirect()->back();
    }
}
