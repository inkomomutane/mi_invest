<?php

namespace App\Actions\BusinessRule;

use App\Models\BusinessRule;
use Illuminate\Http\RedirectResponse;

class DeleteBusinessRule
{

    public function handle(BusinessRule $businessRule): bool
    {
        if ($businessRule->properties->isEmpty()) {
            try {
                $businessRule->delete();
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

    public function __invoke(BusinessRule $businessRule): RedirectResponse
    {
        $this->handle($businessRule);

        return redirect()->back();
    }
}
