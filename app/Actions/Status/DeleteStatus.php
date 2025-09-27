<?php

namespace App\Actions\Status;

use App\Models\Status;
use Illuminate\Http\RedirectResponse;

class DeleteStatus
{

    public function handle(Status $status): bool
    {
        if ($status->properties->isEmpty()) {
            try {
                $status->delete();
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

    public function __invoke(Status $status): RedirectResponse
    {
        $this->handle($status);

        return redirect()->back();
    }
}
