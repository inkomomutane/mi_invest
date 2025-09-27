<?php

namespace App\Actions\Attribute;

use App\Models\Attribute;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CreateAttribute
{
    /**
     * @throws \Throwable
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|unique:attributes,name',
            'description' => 'required|string',
            'image' => 'required',
        ]);

        try {
            \DB::beginTransaction();
            $attribute = Attribute::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            if ($request->hasFile('image') && count($request->image) > 0) {
                $attribute->addMedia($request->image[0])->toMediaCollection('attributes', 'attributes');
            }
            \DB::commit();
            flash()->addSuccess(__('messages.attribute_created_success'));
        } catch (\Exception $exception) {
            flash()->addError(__('messages.attribute_create_error'));
        }

        return \redirect()->back();
    }
}
