<?php

namespace App\Actions\Property;

use App\Models\Comment;
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
        /** @var Property $propertyModel */
        $propertyModel = Property::onlyTrashed()->whereId($property)->firstOrFail();

        if ($propertyModel->trashed()) {
            try {
                Rating::whereIn('id', $propertyModel->ratings->pluck('id'))->delete();
                Comment::whereIn('id', $propertyModel->comments->pluck('id'))->delete();
                $propertyModel->forceDelete();
                flash()->addSuccess(__('messages.action_success'));

                return to_route('property.all.trash');
            } catch (\Throwable $e) {
                flash()->addError(__('messages.action_error'));
                return to_route('property.all.trash');
            }
        } else {
            flash()->addError(__('messages.action_error'));

            return to_route('property.all.trash');
        }
    }
}
