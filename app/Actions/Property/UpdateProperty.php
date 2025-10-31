<?php

namespace App\Actions\Property;

use App\Data\PropertyData;
use App\Models\Property;

class UpdateProperty
{

    public function __invoke(Property $property, PropertyData $propertyData)
    {
        $data = collect($propertyData->all())
            ->put('published_at', now())
            ->except('images')->toArray();
        try {
            $property->update($data);
            if (request()->hasFile('images')) {
                foreach ($propertyData->images as $image) {
                    $property->addMedia($image)->toMediaCollection('posts', 'posts');
                }
            }
            flash()->addSuccess(__('messages.property_updated_success'));

            return to_route($property->approved ? 'property.all' : 'property.not.approved.all');
        } catch (\Throwable $e) {
            throw $e;
            flash()->addError(__('messages.property_update_error'));

            return back();
        }
    }
}
