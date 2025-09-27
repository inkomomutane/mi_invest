<?php

namespace App\Actions\BusinessRule;

use App\Models\BusinessRule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateBusinessRule
{


    public function __invoke(Request $request, BusinessRule $businessRule)
    {
        $validated = $request->validate([
            'name' => ['required', Rule::unique(BusinessRule::class, 'name')->ignore($businessRule->id, 'id')],
        ]);

        try {
            $businessRule->name = $validated['name'];
            $businessRule->save();
            flash()->addSuccess(__('messages.business_rule_updated_success'));
        } catch (\Throwable $th) {
            flash()->addError(__('messages.action_error'));
        }

        return \redirect()->back();
    }
}
