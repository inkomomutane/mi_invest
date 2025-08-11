<?php

namespace App\Actions\Status;

use App\Models\Status;
use App\Support\Enums\SystemRoles;
use Illuminate\Http\Request;

class DeleteStatus
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

    public function handle(Status $status): bool
    {
        if ($status->properties->isEmpty()) {
            try {
                $status->delete();
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

    public function __invoke(Status $status)
    {
        $this->handle($status);

        return redirect()->back();
    }
}
