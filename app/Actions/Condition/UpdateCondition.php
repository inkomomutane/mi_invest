<?php

namespace App\Actions\Condition;

use App\Models\Condition;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateCondition
{


    public function __invoke(Request $request,Condition $condition)
    {
        $validated = $request->validate([
            'name' => ['required', Rule::unique(Condition::class, 'name')->ignore($condition->id, 'id')],
        ]);

        try {
            $condition->name = $validated['name'];
            $condition->save();
            flash()->addSuccess(__('messages.condition_updated_success'));
        } catch (\Throwable $th) {
            flash()->addError(__('messages.action_error'));
        }

        return \redirect()->back();
    }
}
