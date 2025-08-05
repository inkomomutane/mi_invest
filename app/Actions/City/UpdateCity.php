<?php

namespace App\Actions\City;

use App\Models\City;
use Illuminate\Validation\Rule;

class UpdateCity
{

    public function __invoke(City $city)
    {
        $validated = $request->validate([
            'nome' => ['required', Rule::unique(City::class, 'nome')->ignore($city->id, 'id')],
            'province_id' => 'required|numeric',
        ]);

        try {
            $city->nome = $validated['nome'];
            $city->province_id = $validated['province_id'];
            $city->save();
            flash()->addSuccess(__('messages.city_updated_success'));
        } catch (\Throwable $th) {
            throw $th;
            flash()->addError(__('messages.action_error'));
        }

        return \redirect()->back();
    }
}
