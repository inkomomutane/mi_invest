<?php

namespace App\Actions\IntermediationRule;

use App\Models\IntermediationRule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateIntermediationRule
{

    public function __invoke(Request $request, IntermediationRule $intermediationRule)
    {
        $validated = $request->validate([
            'name' => ['required', Rule::unique(IntermediationRule::class, 'name')->ignore($intermediationRule->id, 'id')],
            'code' => ['required', Rule::unique(IntermediationRule::class, 'code')->ignore($intermediationRule->id, 'id')],
            'percentage' => 'required|numeric|min:0|max:100',
        ]);

        try {
            $intermediationRule->name = $validated['name'];
            $intermediationRule->code = $validated['code'];
            $intermediationRule->percentage = $validated['percentage'];
            $intermediationRule->save();
            flash()->addSuccess(__('messages.intermediation_rule_updated_success'));
        } catch (\Throwable $th) {
            flash()->addError(__('messages.action_error'));
        }

        return \redirect()->back();
    }
}
