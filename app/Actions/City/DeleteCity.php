<?php

namespace App\Actions\City;

use App\Models\City;

class DeleteCity
{

    public function handle(City $city): bool
    {
        if ($city->neighborhoods->isEmpty()) {
            try {
                $city->delete();
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

    public function __invoke(City $city)
    {
        $this->handle($city);

        return redirect()->back();
    }
}
