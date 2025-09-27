<?php

namespace App\Actions\Neighborhood;

use App\Models\Neighborhood;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateNeighborhood
{

    public function __invoke(Request $request, Neighborhood $neighborhood): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', Rule::unique(Neighborhood::class, 'name')->ignore($neighborhood->id, 'id')],
            'city_id' => 'required|exists:cities,id',
        ]);

        try {
            $neighborhood->name = $validated['name'];
            $neighborhood->city_id = $validated['city_id'];
            $neighborhood->save();
            flash()->addSuccess(__('messages.neighborhood_updated_success'));
        } catch (\Throwable $th) {
            flash()->addError(__('messages.action_error'));
        }

        return \redirect()->back();
    }
}
