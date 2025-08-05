<?php

namespace App\Actions\Condition;

use App\Data\ConditionData;
use App\Models\Condition;
use App\Support\Enums\SystemRoles;
use Illuminate\Http\Request;

class CreateCondition
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

    public function handle(ConditionData $conditionData)
    {
        return Condition::create($conditionData->all());
    }

    public function rules()
    {
        return [
            'nome' => 'required|unique:conditions,nome',
        ];
    }

    public function __invoke(Request $request)
    {
        $this->handle(ConditionData::from($request->validated()));
        flash()->addSuccess(__('messages.condition_created_success'));

        return \redirect()->back();
    }
}
