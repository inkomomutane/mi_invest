<?php

namespace App\Support\Traits;

use App\Models\Property;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait GetPropertiesWithSearchScope
{
    /**
     * @return Collection<Property>
     *
     **/
    private function getProperties(?string $term = null, bool $approved = true)
    {

        $query = Property::query()->when($term, function ($query, $search) {
            $query->where('titulo', 'like', '%'.$search.'%')
                ->orWhereRelation('neighborhood', 'nome', 'like', '%'.$search.'%')
                ->orWhereRelation('neighborhood.city', 'nome', 'like', '%'.$search.'%')
                ->orWhereRelation('neighborhood.city.province', 'name', 'like', '%'.$search.'%');
            $query->with(['corretor', 'businessRule', 'intermediationRule', 'neighborhood.city.province', 'media' => function (MorphMany $query) {
                $query->where('collection_name', 'posts')->first();
            }, ]);
        })->with(['corretor', 'businessRule', 'neighborhood.city.province', 'intermediationRule', 'media' => function (MorphMany $query) {
            $query->where('collection_name', 'posts');
        }, ]);

        if (! $approved) {
            return $query->withoutApproved()->orderBy('updated_at', 'desc')->get();
        }

        return $query->withApproved()->orderBy('updated_at', 'desc')->get();
    }
}
