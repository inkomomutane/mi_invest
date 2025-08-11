<?php

namespace App\Actions\BusinessRule;

use App\Data\BusinessRuleData;
use App\Models\BusinessRule;
use App\Support\Enums\SystemRoles;
use Inertia\Inertia;
use Illuminate\Http\Request;

class GetBusinessRules
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
        return BusinessRuleData::collect(
            BusinessRule::query()
                ->when($term, function ($query, $search) {
                    $query->where('name', 'like', '%'.$search.'%');
                })->
            orderBy('created_at', 'desc')->paginate(5)->withQueryString()
        );
    }

    public function __invoke()
    {
        return Inertia::render('BusinessRule/Index', [
            'regrasDeBusinessRule' => $this->handle(request()->search),
        ]);
    }
}
