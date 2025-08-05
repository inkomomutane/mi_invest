<?php

namespace App\Actions\Property;

use App\Models\Comentario;
use App\Models\Property;
use App\Models\Rating;
use App\Support\Enums\SystemRoles;
use Illuminate\Http\Request;

class ApprovePropertyDeletion
{

    public function authorize(Request $request): bool
    {
        /** @var User $user */
        $user = $request->user();

        return $user->hasAnyRole(
            SystemRoles::SUPERADMIN,
            SystemRoles::ADMIN,
            SystemRoles::SUBADMIN,
            SystemRoles::REALSTATEAGENCY
        );
    }

    public function __invoke(int $property)
    {
        /** @var Property $property */
        $property = Property::onlyTrashed()->whereId($property)->first();

        if (! is_null($property) && $property->trashed()) {
            try {
                Rating::whereIn('id', $property->ratings->pluck('id'))->delete();
                Comentario::whereIn('id', $property->comentarios->pluck('id'))->delete();
                $property->forceDelete();
                flash()->addSuccess(__('messages.action_success'));

                return to_route('property.all.trash');
            } catch (\Throwable $e) {
                throw $e;
                flash()->addError(__('messages.action_error'));

                return to_route('property.all.trash');
            }
        } else {
            flash()->addError(__('messages.action_error'));

            return to_route('property.all.trash');
        }
    }
}
