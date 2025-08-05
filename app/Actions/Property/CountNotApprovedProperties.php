<?php

namespace App\Actions\Property;

use App\Actions\UserTreeInIdArray;
use App\Models\Property;
use App\Models\User;
use App\Support\Enums\SystemRoles;

class CountNotApprovedProperties
{
    public function handle(?User $user)
    {

        if (is_null($user)) {
            return 0;
        }

        /** @var Collection<Property> $properties */
        $properties = Property::withoutApproved();

        if ($user->hasAnyRole(SystemRoles::SUPERADMIN, SystemRoles::ADMIN)) {
            return $properties->count();
        }

        return $properties->whereIn('broker_id', UserTreeInIdArray::run($user))->count();
    }
}
