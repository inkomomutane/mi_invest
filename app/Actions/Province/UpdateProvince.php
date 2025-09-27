<?php

namespace App\Actions\Province;

use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateProvince
{


    public function __invoke(Request $request,Province $province)
    {
        $validated = $request->validate([
            'name' => ['required', Rule::unique(Province::class, 'name')->ignore($province->id, 'id')],
        ]);

        try {
            $province->name = $validated['name'];
            $province->save();
            flash()->addSuccess(__('messages.province_updated_success'));
        } catch (\Throwable $th) {
            flash()->addError(__('messages.action_error'));
        }

        return \redirect()->back();
    }
}
