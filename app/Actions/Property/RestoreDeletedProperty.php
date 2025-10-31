<?php

namespace App\Actions\Property;

use App\Models\Property;
use Illuminate\Http\RedirectResponse;

class RestoreDeletedProperty
{

    public function __invoke(int $property): RedirectResponse
    {
        /** @var Property $property */
        $property = Property::onlyTrashed()->whereId($property)->firstOrFail();

        if (! is_null($property) && $property->trashed()) {
            try {
                $property->updated_at = now();
                $property->save();
                $property->restore();
                flash()->addSuccess('Property restorado com sucesso.');

                return to_route('property.all');
            } catch (\Throwable $e) {
                throw $e;
                flash()->addError(__('messages.action_error'));

                return to_route('property.all');
            }
        } else {
            flash()->addError(__('messages.action_error'));

            return to_route('property.all');
        }
    }
}
