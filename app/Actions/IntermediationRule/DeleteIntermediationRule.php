<?php

namespace App\Actions\IntermediationRule;

use App\Models\IntermediationRule;
use Illuminate\Http\RedirectResponse;

class DeleteIntermediationRule
{

    public function handle(IntermediationRule $intermediationRule): bool
    {
        if ($intermediationRule->properties->isEmpty()) {
            try {
                $intermediationRule->delete();
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

    public function __invoke(IntermediationRule $intermediationRule): RedirectResponse
    {
        $this->handle($intermediationRule);

        return redirect()->back();
    }
}
