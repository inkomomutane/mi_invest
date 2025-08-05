<?php

namespace App\Actions\BusinessRule;

use App\Models\BusinessRule;
use App\Support\Enums\SystemRoles;
use Illuminate\Http\Request;

class DeleteBusinessRule
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

    public function handle(BusinessRule $businessRule): bool
    {
        if ($businessRule->properties->isEmpty()) {
            try {
                $businessRule->delete();
                flash()->addSuccess(__('messages.action_success'));

                return true;
            } catch (\Throwable $e) {
                flash()->addError(__('messages.action_error'));

                return false;
            }
        } else {
            flash()->addError(__('messages.action_error'));

            return false;
        }
    }

    public function __invoke(BusinessRule $businessRule)
    {
        $this->handle($businessRule);

        return redirect()->back();
    }
}
