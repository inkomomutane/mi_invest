<?php

namespace App\Actions\Neighborhood;

use App\Models\Neighborhood;

class DeleteNeighborhood
{

    public function handle(Neighborhood $neighborhood): bool
    {
        if ($neighborhood->properties->isEmpty()) {
            try {
                $neighborhood->delete();
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

    public function __invoke(Neighborhood $neighborhood)
    {
        $this->handle($neighborhood);

        return redirect()->back();
    }
}
