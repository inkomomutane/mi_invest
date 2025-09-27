<?php

namespace App\Actions\TranstionType;

use App\Support\Enums\SystemRoles;
use Illuminate\Http\Request;

class DeleteTransactionType
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

    public function handle(PropertyFor $propertyFor): bool
    {
        if ($propertyFor->properties->isEmpty()) {
            try {
                $propertyFor->delete();
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

    public function __invoke(PropertyFor $transactionType)
    {
        $this->handle($transactionType);

        return redirect()->back();
    }
}
