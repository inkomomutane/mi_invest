<?php

namespace App\Actions\IntermediationRule;

use App\Models\IntermediationRule;
use App\Support\Enums\SystemRoles;
use Illuminate\Http\Request;

class DeleteIntermediationRule
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

    public function __invoke(IntermediationRule $intermediation)
    {
        if ($intermediation->properties->isEmpty()) {
            try {
                $intermediation->delete();
                flash()->addSuccess(__('messages.action_success'));
            } catch (\Throwable $e) {
                flash()->addError(__('messages.action_error'));
            }
        } else {

            flash()->addError(__('messages.action_error'));
        }

        return redirect()->back();
    }
}
