<?php

namespace App\Actions\Property;

use App\Actions\User\UserTreeInIdArray;
use App\Data\PropertyData;
use App\Models\Property;
use App\Models\User;
use App\Support\Enums\SystemRoles;
use App\Support\Traits\GetPropertiesWithSearchScope;
use Auth;
use Illuminate\Support\Collection;
use Inertia\Inertia;

class GetProperties
{

    use GetPropertiesWithSearchScope;

    public function handle(?string $term, User $user)
    {
        if ($user->hasAnyRole(SystemRoles::SUPERADMIN, SystemRoles::ADMIN)) {
            return PropertyData::collect(
                $this->getProperties($term)->paginate(5)->withQueryString()
            );
        } else {

            /** @var Collection<Property> $properties */
            $properties = $this->getProperties($term);

            return PropertyData::collect($properties->whereIn('broker_id', UserTreeInIdArray::run($user))->paginate(5)->withQueryString());
        }
    }

    public function __invoke(): \Inertia\Response
    {
        return Inertia::render('Property/Index', [
            'properties' => $this->handle(request()->search, Auth::user()),
        ]);
    }
}
