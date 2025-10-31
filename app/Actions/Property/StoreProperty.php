<?php

namespace App\Actions\Property;

use App\Data\PropertyData;
use App\Models\Property;

class StoreProperty
{



    public function __invoke(PropertyData $actionRequest)
    {
        $data = collect($actionRequest->all())
            ->put('broker_id', auth()->user()->id)
            ->put('published_at', now())
            ->except('images')->toArray();
        try {
            $property = Property::create($data);
            if (request()->hasFile('images')) {
                foreach ($actionRequest->images as $image) {
                    $property->addMedia($image)->toMediaCollection('posts', 'posts');
                }
            }
            flash()->addSuccess(__('messages.action_success'));

            return to_route('property.not.approved.all');
        } catch (\Throwable $e) {
            throw $e;
            flash()->addError(__('messages.action_error'));

            return back();
        }
    }
}
