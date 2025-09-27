<?php

namespace App\Actions\BusinessRule;

use App\Data\BusinessRuleData;
use App\Models\BusinessRule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CreateBusinessRule
{

    public function handle(BusinessRuleData $businessRule): BusinessRule
    {
        return BusinessRule::create($businessRule->all());
    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:business_rules,name',
        ];
    }

    public function __invoke(Request $request): RedirectResponse
    {
        $this->handle(BusinessRuleData::from($request->validate($this->rules())));
        flash()->addSuccess(__('messages.business_rule_created_success'));
        return \redirect()->back();
    }
}
