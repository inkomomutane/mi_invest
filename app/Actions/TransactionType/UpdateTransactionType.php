<?php

namespace App\Actions\TransactionType;

use App\Data\TransactionTypeData;
use App\Models\TransactionType;
use App\Models\User;
use App\Support\Enums\SystemRoles;
class UpdateTransactionType
{

    public function authorize(User $user): bool
    {
        return $user->hasAnyRole(
            SystemRoles::SUPERADMIN,
            SystemRoles::ADMIN
        );
    }

    public function __invoke(TransactionType $transactionType,TransactionTypeData $request)
    {

        abort_if(!$this->authorize(auth()->user()), 403);

        try {
            $transactionType->name = $request->name;
            $transactionType->prefix = $request->prefix;
            $transactionType->save();
            flash()->addSuccess(__('messages.action_success'));
        } catch (\Throwable $th) {
            flash()->addError(__('messages.action_error'));
        }

        return \redirect()->back();
    }
}
