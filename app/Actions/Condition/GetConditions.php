<?php

namespace App\Actions\Condition;

use App\Data\ConditionData;
use App\Models\Condition;
use Illuminate\Contracts\Pagination\Paginator;
use Inertia\Inertia;

class GetConditions
{

    public function handle(?string $term = null): Paginator|array|\Illuminate\Support\Enumerable|\Illuminate\Support\Collection|\Spatie\LaravelData\PaginatedDataCollection|\Spatie\LaravelData\CursorPaginatedDataCollection|\Illuminate\Pagination\AbstractCursorPaginator|\Illuminate\Support\LazyCollection|\Spatie\LaravelData\DataCollection|\Illuminate\Pagination\AbstractPaginator|\Illuminate\Contracts\Pagination\CursorPaginator
    {
        return ConditionData::collect(
            Condition::query()
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
        return Inertia::render('Condition/Index', [
            'conditions' => $this->handle(request()->search),
        ]);
    }
}
