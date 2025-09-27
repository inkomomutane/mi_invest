<?php

namespace App\Actions\PropertyType;

use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdatePropertyType
{

    public function __invoke(Request $request, PropertyType $propertyType): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', Rule::unique(PropertyType::class, 'name')->ignore($propertyType->id, 'id')],
            'images' => 'nullable',
            'images.*' => 'image|max:15360',
        ]);

        try {
            $propertyType->name = $validated['name'];
            $propertyType->save();

            if ($request->file('images')) {
                foreach ($request->file('images') as $file) {
                    $propertyType->addMedia($file)
                        ->toMediaCollection('icons');
                }
            }

            flash()->addSuccess(__('messages.property_type_updated_success'));
        } catch (\Throwable $th) {
            flash()->addError(__('messages.action_error'));
        }

        return \redirect()->back();
    }
}
