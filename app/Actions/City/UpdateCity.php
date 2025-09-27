<?php

namespace App\Actions\City;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateCity
{

    public function __invoke(Request $request,City $city): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', Rule::unique(City::class, 'name')->ignore($city->id, 'id')],
            'province_id' => 'required|numeric',
        ]);

        try {
            $city->name = $validated['name'];
            $city->province_id = $validated['province_id'];
            $city->save();
            flash()->addSuccess(__('messages.city_updated_success'));
        } catch (\Throwable $th) {
         #   throw $th;
            flash()->addError(__('messages.action_error'));
        }

        return \redirect()->back();
    }
}
