<?php

namespace App\Actions\Attribute;

use App\Data\AttributeData;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GetAttributes
{
    public function __invoke(Request $request): \Inertia\Response
    {
        $term = $request->get('search');

        $attributes = Attribute::query()
            ->when($term, function ($query, $search) {
                $query->where('name', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%')
                    ->with('media');
            })->with('media')->orderBy('created_at', 'desc')->paginate(5)->withQueryString();

        return Inertia::render('Attribute/Index', [
            'attributes' => AttributeData::collect($attributes),
        ]);
    }
}
