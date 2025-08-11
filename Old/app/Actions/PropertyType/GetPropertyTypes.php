<?php

namespace App\Actions\PropertyType;

use App\Data\PropertyTypeData;
use App\Models\PropertyType;
use App\Support\Enums\SystemRoles;
use Inertia\Inertia;
use Illuminate\Http\Request;

class GetPropertyTypes
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

        $neighborhoods = PropertyType::query()
            ->when($term, function ($query, $search) {
                $query->where('nome', 'like', '%'.$search.'%');
            })->with('media')->orderBy('created_at', 'desc')->paginate(5)->withQueryString();

        return PropertyTypeData::collect(
            $neighborhoods
        );
    }

    public function __invoke()
    {
        return Inertia::render(
            'PropertyType/Index',
            [
                'propertyTypes' => $this->handle(request()->search),
            ]
        );
    }
}
