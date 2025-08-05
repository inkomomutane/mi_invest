<?php

namespace App\Actions\Attribute;

use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateAttribute
{
    public function __invoke(Attribute $attribute, Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', Rule::unique(Attribute::class, 'name')->ignore($attribute->id, 'id')],
            'description' => 'required|string',
            'image' => 'nullable',
        ]);

        try {
            $attribute->name = $validated['name'];
            $attribute->description = $validated['description'];
            $attribute->save();
            if ($request->hasFile('image')) {
                $attribute->addMedia($request->image)->toMediaCollection('attributes', 'attributes');
            }

            flash()->addSuccess(__('messages.attribute_updated_success'));
        } catch (\Throwable $th) {
            flash()->addError(__('messages.attribute_update_error'));
        }

        return \redirect()->back();
    }
}
