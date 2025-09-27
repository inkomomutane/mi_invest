<?php

namespace App\Actions\Status;

use App\Data\StatusData;
use App\Models\Status;
use Illuminate\Contracts\Pagination\Paginator;
use Inertia\Inertia;

class GetStatuses
{

    public function handle(?string $term = null): Paginator|array|\Illuminate\Support\Enumerable|\Illuminate\Support\Collection|\Spatie\LaravelData\PaginatedDataCollection|\Spatie\LaravelData\CursorPaginatedDataCollection|\Illuminate\Pagination\AbstractCursorPaginator|\Illuminate\Support\LazyCollection|\Spatie\LaravelData\DataCollection|\Illuminate\Pagination\AbstractPaginator|\Illuminate\Contracts\Pagination\CursorPaginator
    {
        return StatusData::collect(
            Status::query()
                ->when($term, function ($query, $search) {
                    $query->whereAny([
                        'name',
                    ], 'like', '%'.$search.'%');
                })->
            orderBy('created_at', 'desc')->paginate(5)->withQueryString()
        );
    }

    public function __invoke(): \Inertia\Response
    {
        return Inertia::render('Status/Index', [
            'statuses' => $this->handle(request()->search),
        ]);
    }
}
