<?php

namespace App\Actions\PropertyType;

use App\Models\PropertyType;
use Illuminate\Http\RedirectResponse;

class DeletePropertyType
{

    public function handle(PropertyType $propertyType): bool
    {
        if ($propertyType->properties->isEmpty()) {
            try {
                $propertyType->delete();
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

    public function __invoke(PropertyType $propertyType): RedirectResponse
    {
        $this->handle($propertyType);

        return redirect()->back();
    }
}
