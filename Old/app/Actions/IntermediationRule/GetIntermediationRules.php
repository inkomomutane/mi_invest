<?php

namespace App\Actions\IntermediationRule;

use App\Data\IntermediationRuleData;
use App\Models\IntermediationRule;
use App\Support\Enums\SystemRoles;
use Inertia\Inertia;
use Illuminate\Http\Request;

class GetIntermediationRules
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
        $intermediations = IntermediationRule::query()
            ->when($term, function ($query, $search) {
                $query->where('name', 'like', '%'.$search.'%')
                    ->orWhere('code', 'like', '%'.$search.'%')
                    ->orWhere('percentage', 'like', '%'.$search.'%');
            })->orderBy('created_at', 'desc')->paginate(5)->withQueryString();

        return IntermediationRuleData::collect(
            $intermediations
        );
    }

    public function __invoke()
    {
        return Inertia::render(
            'Intermediation/Index',
            [
                'intermediations' => $this->handle(request()->search),
            ]
        );
    }
}
