<?php

namespace App\Actions\IntermediationRule;

use App\Models\IntermediationRule;
use App\Support\Enums\SystemRoles;
use Illuminate\Http\Request;

class UpdateIntermediationRule
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

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'code' => ['required', 'string'],
            'percentage' => ['required', 'numeric'],
        ];
    }

    public function __invoke(IntermediationRule $intermediation, Request $actionRequest)
    {
        try {
            $intermediation->name = $actionRequest->name;
            $intermediation->code = $actionRequest->code;
            $intermediation->percentage = $actionRequest->percentage;
            $intermediation->save();

            flash()->addSuccess(__('messages.action_success'));
        } catch (\Throwable $th) {
            flash()->addError(__('messages.intermediation_rule_update_error'));
        }

        return \redirect()->back();

    }
}
