<?php

namespace App\Actions\BusinessRule;

use App\Models\BusinessRule;
use App\Support\Enums\SystemRoles;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UpdateBusinessRule
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

    public function __invoke(BusinessRule $businessRule)
    {
        $validated = $request->validate([
            'name' => ['required', Rule::unique(BusinessRule::class, 'name')->ignore($businessRule->id, 'id')],
        ]);

        try {
            $businessRule->name = $validated['name'];
            $businessRule->save();
            flash()->addSuccess(__('messages.action_success'));
        } catch (\Throwable $th) {
            flash()->addError(__('messages.action_error'));
        }

        return \redirect()->back();
    }
}
