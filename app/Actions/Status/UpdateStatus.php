<?php

namespace App\Actions\Status;

use App\Models\Status;
use App\Support\Enums\SystemRoles;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UpdateStatus
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

    public function __invoke(Status $status, Request $request)
    {
        $validated = $request->validate([
            'nome' => ['required', Rule::unique(Status::class, 'nome')->ignore($status->id, 'id')],
        ]);

        try {
            $status->nome = $validated['nome'];
            $status->save();
            flash()->addSuccess(__('messages.status_updated_success'));
        } catch (\Throwable $th) {
            flash()->addError(__('messages.status_update_error'));
        }

        return \redirect()->back();
    }
}
