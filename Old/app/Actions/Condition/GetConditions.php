<?php

namespace App\Actions\Condition;

use App\Data\ConditionData;
use App\Models\Condition;
use App\Support\Enums\SystemRoles;
use Inertia\Inertia;
use Illuminate\Http\Request;

class GetConditions
{

    public function authorize(Request $request): bool
    {
        /** @var User $user */
        $user = $request->user();

        return $user->hasAnyRole(
            SystemRoles::SUPERADMIN,
            SystemRoles::ADMIN
        );
    }

    public function handle(?string $term = null)
    {
        return ConditionData::collect(
            Condition::query()
                ->when($term, function ($query, $search) {
                    $query->where('nome', 'like', '%'.$search.'%');
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
