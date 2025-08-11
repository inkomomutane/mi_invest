<?php

namespace App\Actions\Condition;

use App\Models\Condition;
use App\Support\Enums\SystemRoles;
use Illuminate\Http\Request;

class DeleteCondition
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

    public function handle(Condition $condition): bool
    {
        if ($condition->properties->isEmpty()) {
            try {
                $condition->delete();
                flash()->addSuccess(__('messages.condition_deleted_success'));

                return true;
            } catch (\Throwable $e) {
                flash()->addError(__('messages.condition_delete_error'));

                return false;
            }
        } else {
            flash()->addError(__('messages.condition_delete_has_properties'));

            return false;
        }
    }

    public function __invoke(Condition $condition)
    {
        $this->handle($condition);

        return redirect()->back();
    }
}
