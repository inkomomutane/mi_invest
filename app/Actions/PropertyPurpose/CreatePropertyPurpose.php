<?php

namespace App\Actions\PropertyPurpose;

use App\Data\PropertyPurposeData;
use App\Models\PropertyPurpose;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CreatePropertyPurpose
{

    public function handle(array $propertyPurpose): PropertyPurpose
    {
        return PropertyPurpose::create($propertyPurpose);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:property_purposes,name',
            'slug_text' => 'required|unique:property_purposes,slug_text',
        ];
    }

    public function __invoke(Request $request): RedirectResponse
    {
        $this->handle($request->validate($this->rules()));
        flash()->addSuccess(__('messages.property_purpose_created_success'));
        return \redirect()->back();
    }
}
