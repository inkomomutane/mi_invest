<?php

namespace App\Actions\BusinessRule;

use App\Data\BusinessRuleData;
use App\Models\BusinessRule;
use App\Support\Enums\SystemRoles;
use Illuminate\Http\Request;

class CreateBusinessRule
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

    public function handle(BusinessRuleData $businessRuleData)
    {
        return BusinessRule::create($businessRuleData->all());
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:regra_de_businesss,name',
        ];
    }

    public function __invoke(Request $request)
    {
        $this->handle(BusinessRuleData::from($request->validated()));
        flash()->addSuccess(__('messages.action_success'));

        return \redirect()->back();
    }
}
