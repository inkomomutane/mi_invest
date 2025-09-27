<?php

namespace App\Actions\Condition;

use App\Data\ConditionData;
use App\Models\Condition;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CreateCondition
{

    public function handle(ConditionData $condition): Condition
    {
        return Condition::create($condition->all());
    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:conditions,name',
        ];
    }

    public function __invoke(Request $request): RedirectResponse
    {
        $this->handle(ConditionData::from($request->validate($this->rules())));
        flash()->addSuccess(__('messages.condition_created_success'));
        return \redirect()->back();
    }
}
