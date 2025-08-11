<?php

namespace App\Actions\PropertyType;

use App\Models\PropertyType;
use App\Support\Enums\SystemRoles;
use Illuminate\Http\Request;

class DeletePropertyType
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

    public function handle(PropertyType $tipoDeProperty): bool
    {
        if ($tipoDeProperty->properties->isEmpty()) {
            try {
                $tipoDeProperty->delete();
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

    public function __invoke(PropertyType $propertyType)
    {
        $this->handle($propertyType);

        return redirect()->back();
    }
}
