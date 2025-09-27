<?php

namespace App\Actions\PropertyPurpose;

use App\Models\PropertyPurpose;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdatePropertyPurpose
{

    public function __invoke(Request $request, PropertyPurpose $propertyPurpose)
    {
        $validated = $request->validate([
            'name' => ['required', Rule::unique(PropertyPurpose::class, 'name')->ignore($propertyPurpose->id, 'id')],
            'slug_text' => ['required', Rule::unique(PropertyPurpose::class, 'slug_text')->ignore($propertyPurpose->id, 'id')],
        ]);

        try {
            $propertyPurpose->name = $validated['name'];
            $propertyPurpose->slug_text = $validated['slug_text'];
            $propertyPurpose->save();
            flash()->addSuccess(__('messages.property_purpose_updated_success'));
        } catch (\Throwable $th) {
            flash()->addError(__('messages.action_error'));
        }

        return \redirect()->back();
    }
}