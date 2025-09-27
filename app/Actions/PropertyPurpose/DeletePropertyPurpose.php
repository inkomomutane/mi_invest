<?php

namespace App\Actions\PropertyPurpose;

use App\Models\PropertyPurpose;
use Illuminate\Http\RedirectResponse;

class DeletePropertyPurpose
{

    public function handle(PropertyPurpose $propertyPurpose): bool
    {
        if ($propertyPurpose->properties->isEmpty()) {
            try {
                $propertyPurpose->delete();
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

    public function __invoke(PropertyPurpose $propertyPurpose): RedirectResponse
    {
        $this->handle($propertyPurpose);

        return redirect()->back();
    }
}