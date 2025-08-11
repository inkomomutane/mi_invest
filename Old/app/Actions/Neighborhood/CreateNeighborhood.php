<?php

namespace App\Actions\Neighborhood;

use App\Models\Neighborhood;
use Illuminate\Http\Request;

class CreateNeighborhood
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:neighborhoods,name',
            'city_id' => 'required|numeric',
        ]);

        try {
            Neighborhood::create($validated);
            flash()->addSuccess(__('messages.neighborhood_created_success'));
        } catch (\Exception $exception) {
            flash()->addError(__('messages.neighborhood_create_error'));
        }

        return \redirect()->back();
    }
}
