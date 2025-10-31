<?php

namespace App\Actions\TransactionType;

use App\Models\TransactionType;
use App\Models\User;
use App\Support\Enums\SystemRoles;

class DeleteTransactionType
{

    public function authorize(User $user): bool
    {
        return $user->hasAnyRole(
            SystemRoles::SUPERADMIN,
            SystemRoles::ADMIN
        );
    }

    public function handle(TransactionType $transactionType): bool
    {
        if ($transactionType->properties->isEmpty()) {
            try {
                $transactionType->delete();
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

    public function __invoke(TransactionType $transactionType): \Illuminate\Http\RedirectResponse
    {
        abort_if(!$this->authorize(auth()->user()), 403);
        $this->handle($transactionType);
        return redirect()->back();
    }
}
