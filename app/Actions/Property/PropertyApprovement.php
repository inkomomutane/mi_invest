<?php

namespace App\Actions\Property;

use App\Models\Property;
use App\Support\Enums\SystemRoles;
use Illuminate\Http\Request;

class PropertyApprovement
{

    public function authorize(Request $request): bool
    {
        /** @var User $user */
        $user = $request->user();

        return $user->hasAnyRole(
            SystemRoles::SUPERADMIN,
            SystemRoles::ADMIN,
            SystemRoles::SUBADMIN,
        );
    }

    public function rules()
    {
        return [
            'approve' => 'required|boolean',
        ];
    }

    public function __invoke(Property $property, Request $actionRequest)
    {
        if ($actionRequest->approve) {
            ApproveProperty::run($property);
            flash()->addSuccess('Property approvado com sucesso.');
        } else {
            RefuseProperty::run($property);

            flash()->addError('Property recusado e removido automaticamente.');
        }

        return \back();
    }
}
