<?php

namespace App\Actions\IntermediationRule;

use App\Models\IntermediationRule;
use App\Support\Enums\SystemRoles;
use Illuminate\Http\Request;

class CreateIntermediationRule
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

    public function __invoke(Request $actionRequest)
    {
        try {
            IntermediationRule::create([
                'name' => $actionRequest->name,
                'code' => $actionRequest->code,
                'percentage' => $actionRequest->percentage,
            ]);

            flash()->addSuccess(__('messages.action_success'));
        } catch (\Throwable $th) {
            flash()->addError(__('messages.intermediation_rule_create_error'));
        }

        return \redirect()->back();
    }
}
