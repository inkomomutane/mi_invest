<?php

namespace App\Actions\Property;

use App\Actions\User\UserTreeInIdArray;
use App\Models\Property;
use App\Models\User;
use Illuminate\Support\Collection;

class PropertyTrashCount
{/**
     * @return int
     */
    public function handle(?User $user = null)
    {
        if (is_null($user)) {
            return 0;
        }

        /** @var Collection<Property> $properties */
        $properties = Property::onlyTrashed();
        if ($user->hasAnyRole('Super-Admin', 'Admin')) {
            return $properties->count();
        }

        return $properties->whereIn('broker_id', UserTreeInIdArray::run($user))->count();
    }
}
