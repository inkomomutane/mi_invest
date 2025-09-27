<?php

namespace App\Actions\Condition;

use App\Models\Condition;
use Illuminate\Http\RedirectResponse;

class DeleteCondition
{

    public function handle(Condition $condition): bool
    {
        if ($condition->properties->isEmpty()) {
            try {
                $condition->delete();
                flash()->addSuccess(__('messages.action_success'));

                return true;
            } catch (\Throwable $e) {
                flash()->addError(__('messages.action_error'));

                return false;
            }
        } else {
            flash()->addError(__('messages.action_error'));

            return false;
        }
    }

    public function __invoke(Condition $condition): RedirectResponse
    {
        $this->handle($condition);

        return redirect()->back();
    }
}
