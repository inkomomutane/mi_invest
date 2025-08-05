<?php

namespace App\Actions\Province;

use App\Models\Province;

class DeleteProvince
{

    public function handle(Province $province): bool
    {
        if ($province->cities->isEmpty()) {
            try {
                $province->delete();
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

    public function __invoke(Province $province)
    {
        $this->handle($province);

        return redirect()->back();
    }
}
