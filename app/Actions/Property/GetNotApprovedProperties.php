<?php

namespace App\Actions\Property;

use App\Actions\User\UserTreeInIdArray;
use App\Data\PropertyData;
use App\Models\Property;
use App\Models\User;
use App\Support\Enums\SystemRoles;
use App\Support\Traits\GetPropertiesWithSearchScope;
use Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GetNotApprovedProperties
{

    use GetPropertiesWithSearchScope;

    public function authorize(Request $request): bool
    {
        /** @var User $user */
        $user = $request->user();

        return $user->hasAnyRole(
            SystemRoles::SUPERADMIN,
            SystemRoles::ADMIN,
            SystemRoles::SUBADMIN,
            SystemRoles::REALSTATEAGENCY,
            SystemRoles::REALSTATEAGENT
        );
    }

    public function handle(?string $term, User $user)
    {
        if ($user->hasAnyRole(SystemRoles::SUPERADMIN, SystemRoles::ADMIN)) {
            return PropertyData::collect(
                $this->getProperties(term: $term, approved: false)->paginate(5)->withQueryString()
            );
        } else {
            /** @var Collection<Property> $properties */
            $properties = $this->getProperties(term: $term, approved: false);

            return PropertyData::collect($properties->whereIn('broker_id', UserTreeInIdArray::run($user))->paginate(5)->withQueryString());
        }
    }

    public function __invoke(): \Inertia\Response
    {
        /** @var User $user */
        $user = Auth::user();

        return Inertia::render('Property/NotApprovedProperties', [
            'properties' => $this->handle(request()->search, $user),
            'can' => $user->hasAnyRole([
                SystemRoles::SUPERADMIN,
                SystemRoles::ADMIN,
                SystemRoles::SUBADMIN,
            ]),
        ]);
    }
}
