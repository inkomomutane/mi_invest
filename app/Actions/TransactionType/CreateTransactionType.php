<?php

namespace App\Actions\TransactionType;

use App\Data\TransactionTypeData;
use App\Models\PropertyPurpose;
use App\Models\User;
use App\Support\Enums\SystemRoles;

class CreateTransactionType
{

    public function authorize(User $user): bool
    {
        return $user->hasAnyRole(
            SystemRoles::SUPERADMIN,
            SystemRoles::ADMIN
        );
    }

    public function handle(TransactionTypeData $transactionTypeData)
    {
        return PropertyPurpose::create($transactionTypeData->all());
    }


    public function __invoke(TransactionTypeData $request): \Illuminate\Http\RedirectResponse
    {

        abort_if(!$this->authorize(auth()->user()), 403);

        $this->handle($request);
        flash()->addSuccess(__('messages.action_success'));
        return \redirect()->back();
    }
}
