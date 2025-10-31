<?php

namespace App\Actions\User;

use App\Models\User;
use App\Support\Enums\SystemRoles;
use Illuminate\Http\Request;

class DeleteUser
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

    public function handle(User $user, bool $status)
    {
        $user->active = $status;
        $user->save();
        return $user->active;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'boolean'],
        ];
    }

    public function __invoke(User $user, Request $request)
    {
        $validated = $request->validate($this->rules());

        try {
            if ($this->handle($user, $validated['status'])) {
                flash()->addSuccess(__('messages.user_enabled_success'));
            } else {
                flash()->addSuccess(__('messages.user_disabled_success'));
            }
        } catch (\Throwable $th) {
            flash()->addError(__('messages.user_status_change_error') . $th);
        }

        return \redirect()->back();
    }
}
