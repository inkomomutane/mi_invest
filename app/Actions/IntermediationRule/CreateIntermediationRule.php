<?php

namespace App\Actions\IntermediationRule;

use App\Data\IntermediationRuleData;
use App\Models\IntermediationRule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CreateIntermediationRule
{

    public function handle(array $intermediationRule): IntermediationRule
    {
        return IntermediationRule::create($intermediationRule);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:intermediation_rules,name',
            'code' => 'required|unique:intermediation_rules,code',
            'percentage' => 'required|numeric|min:0|max:100',
        ];
    }

    public function __invoke(Request $request): RedirectResponse
    {
        $this->handle(($request->validate($this->rules())));
        flash()->addSuccess(__('messages.intermediation_rule_created_success'));
        return \redirect()->back();
    }
}
