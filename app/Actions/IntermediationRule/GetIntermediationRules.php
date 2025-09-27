<?php

namespace App\Actions\IntermediationRule;

use App\Data\IntermediationRuleData;
use App\Models\IntermediationRule;
use Illuminate\Contracts\Pagination\Paginator;
use Inertia\Inertia;

class GetIntermediationRules
{

    public function handle(?string $term = null): Paginator|array|\Illuminate\Support\Enumerable|\Illuminate\Support\Collection|\Spatie\LaravelData\PaginatedDataCollection|\Spatie\LaravelData\CursorPaginatedDataCollection|\Illuminate\Pagination\AbstractCursorPaginator|\Illuminate\Support\LazyCollection|\Spatie\LaravelData\DataCollection|\Illuminate\Pagination\AbstractPaginator|\Illuminate\Contracts\Pagination\CursorPaginator
    {
        return IntermediationRuleData::collect(
            IntermediationRule::query()
                ->when($term, function ($query, $search) {
                    $query->whereAny([
                        'name',
                        'code',
                    ], 'like', '%'.$search.'%');
                })->
            orderBy('created_at', 'desc')->paginate(5)->withQueryString()
        );
    }

    public function __invoke(): \Inertia\Response
    {
        return Inertia::render('IntermediationRule/Index', [
            'intermediationRules' => $this->handle(request()->search),
        ]);
    }
}
