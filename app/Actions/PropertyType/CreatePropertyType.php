<?php

namespace App\Actions\PropertyType;

use App\Models\PropertyType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CreatePropertyType
{

    public function handle(array $data, Request $request): PropertyType
    {
        $propertyType = PropertyType::create($data);

        if ($request->file('images')) {
            foreach ($request->file('images') as $file) {
                $propertyType->addMedia($file)
                    ->toMediaCollection('icons');
            }
        }

        return $propertyType;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:property_types,name',
            'images' => 'required',
            'images.*' => 'required|image|max:15360',
        ];
    }

    public function __invoke(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->rules());
        
        try {
            $this->handle($validated, $request);
            flash()->addSuccess(__('messages.property_type_created_success'));
        } catch (\Throwable $th) {
            flash()->addError(__('messages.action_error'));
        }

        return \redirect()->back();
    }
}
