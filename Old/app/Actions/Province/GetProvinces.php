<?php

namespace App\Actions\Province;

use App\Data\ProvinceData;
use App\Models\Province;
use Inertia\Inertia;

class GetProvinces
{

    public function handle(?string $term = null)
    {
        return ProvinceData::collect(
            Province::query()
                ->when($term, function ($query, $search) {
                    $query->where('name', 'like', '%'.$search.'%');
                })->
            orderBy('created_at', 'desc')->paginate(5)->withQueryString()
        );
    }

    public function __invoke(): \Inertia\Response
    {
        return Inertia::render('Province/Index', [
            'provinces' => $this->handle(request()->search),
        ]);
    }
}
