<?php

namespace App\Actions\Property\image;

use App\Models\Property;
use Illuminate\Http\Request;

class AddPropertyImages
{
    public function rules(): array
    {
        return [
            'images' => 'required',
            'images.*' => 'required|image|max:15360',
        ];
    }

    public function __invoke(Request $request, Property $property)
    {
        $validated = $request->validate($this->rules());

        try {
            if ($request->file('images')) {
                foreach ($request->file('images') as $key => $file) {
                    $property->addMedia($file)->toMediaCollection('posts', 'posts');
                }
            }

            flash()->addSuccess(__('messages.image_uploaded_success'));
        } catch (\Throwable $th) {
            flash()->addError(__('messages.image_upload_error'));
        }

        return \redirect()->back();
    }
}
