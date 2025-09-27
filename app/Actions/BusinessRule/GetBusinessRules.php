<?php

namespace App\Actions\BusinessRule;

use App\Data\BusinessRuleData;
use App\Models\BusinessRule;
use Illuminate\Contracts\Pagination\Paginator;
use Inertia\Inertia;

class GetBusinessRules
{

    public function handle(?string $term = null): Paginator|array|\Illuminate\Support\Enumerable|\Illuminate\Support\Collection|\Spatie\LaravelData\PaginatedDataCollection|\Spatie\LaravelData\CursorPaginatedDataCollection|\Illuminate\Pagination\AbstractCursorPaginator|\Illuminate\Support\LazyCollection|\Spatie\LaravelData\DataCollection|\Illuminate\Pagination\AbstractPaginator|\Illuminate\Contracts\Pagination\CursorPaginator
    {
        return BusinessRuleData::collect(
            BusinessRule::query()
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
        return Inertia::render('BusinessRule/Index', [
            'businessRules' => $this->handle(request()->search),
        ]);
    }
}
