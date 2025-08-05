<?php

namespace App\Actions\Condition;

use App\Models\Condition;
use App\Support\Enums\SystemRoles;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UpdateCondition
{

    public function authorize(Request $request): bool
    {
        /** @var User $user */
        $user = $request->user();

        return $user->hasAnyRole(
            SystemRoles::SUPERADMIN,
            SystemRoles::ADMIN,
        );
    }

    public function __invoke(Condition $condition)
    {
        $validated = $request->validate([
            'nome' => ['required', Rule::unique(Condition::class, 'nome')->ignore($condition->id, 'id')],
        ]);

        try {
            $condition->nome = $validated['nome'];
            $condition->save();
            flash()->addSuccess(__('messages.condition_updated_success'));
        } catch (\Throwable $th) {
            flash()->addError(__('messages.condition_update_error'));
        }

        return \redirect()->back();
    }
}
