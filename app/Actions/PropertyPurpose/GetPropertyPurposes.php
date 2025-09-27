<?php

namespace App\Actions\PropertyPurpose;

use App\Data\PropertyPurposeData;
use App\Models\PropertyPurpose;
use Illuminate\Contracts\Pagination\Paginator;
use Inertia\Inertia;

class GetPropertyPurposes
{

    public function handle(?string $term = null): Paginator|array|\Illuminate\Support\Enumerable|\Illuminate\Support\Collection|\Spatie\LaravelData\PaginatedDataCollection|\Spatie\LaravelData\CursorPaginatedDataCollection|\Illuminate\Pagination\AbstractCursorPaginator|\Illuminate\Support\LazyCollection|\Spatie\LaravelData\DataCollection|\Illuminate\Pagination\AbstractPaginator|\Illuminate\Contracts\Pagination\CursorPaginator
    {
        return PropertyPurposeData::collect(
            PropertyPurpose::query()
                ->when($term, function ($query, $search) {
                    $query->whereAny([
                        'name',
                        'slug_text',
                    ], 'like', '%'.$search.'%');
                })->
            orderBy('created_at', 'desc')->paginate(5)->withQueryString()
        );
    }

    public function __invoke(): \Inertia\Response
    {
        return Inertia::render('PropertyPurpose/Index', [
            'propertyPurposes' => $this->handle(request()->search),
        ]);
    }
}