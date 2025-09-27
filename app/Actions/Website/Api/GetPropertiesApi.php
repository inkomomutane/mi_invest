<?php

namespace App\Actions\Website\Api;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Lorisleiva\Actions\Concerns\AsController;

class GetPropertiesApi
{
    use AsController;

    public function handle()
    {
        return \App\Data\PropertyData::collect(
            \App\Models\Property::with(['neighborhood.city', 'condition', 'propertyFor', 'media' => function (MorphMany $query) {
                $query->where('collection_name', 'posts');
            }, ])->paginate(12));
    }

    public function AsController()
    {
        return response()->json([
            'properties' => $this->handle(),
        ]);
    }
}
