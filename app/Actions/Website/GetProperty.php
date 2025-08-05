<?php

namespace App\Actions\Website;

use App\Models\Property;

class GetProperty
{

    public function __invoke(Property $property)
    {
        return view('website.property', [
            'property' => $property->load('media'),
        ]);
    }
}
