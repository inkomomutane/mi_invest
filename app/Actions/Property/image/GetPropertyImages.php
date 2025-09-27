<?php

namespace App\Actions\Property\image;

use App\Data\MediaData;
use App\Models\Property;
use Inertia\Inertia;

class GetPropertyImages
{

    public function handle(Property $property)
    {
        return MediaData::collect($property->getMedia('posts')->paginate(5));
    }

    public function __invoke(Property $property)
    {
        return Inertia::render('Property/Image/Index', [
            'images' => $this->handle($property),
            'property' => $property->slug,
        ]);
    }
}
