<?php

namespace App\Actions\Neighborhood;

use App\Models\Neighborhood;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateNeighborhood
{
    public function __invoke(Neighborhood $neighborhood, Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', Rule::unique(Neighborhood::class, 'name')->ignore($neighborhood->id, 'id')],
            'city_id' => 'required|numeric',
        ]);

        try {
            $neighborhood->name = $validated['name'];
            $neighborhood->city_id = $validated['city_id'];
            $neighborhood->save();

            flash()->addSuccess(__('messages.neighborhood_updated_success'));
        } catch (\Throwable $th) {
            flash()->addError(__('messages.neighborhood_update_error'));
        }

        return \redirect()->back();
    }
}
