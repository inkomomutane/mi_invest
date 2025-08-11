<?php

namespace App\Actions\Neighborhood;

use App\Models\Neighborhood;
use Illuminate\Http\Request;

class DeleteNeighborhood
{
    public function __invoke(Neighborhood $neighborhood, Request $request)
    {
        if ($neighborhood->properties->isEmpty()) {
            try {
                $neighborhood->delete();
                flash()->addSuccess(__('messages.neighborhood_deleted_success'));
            } catch (\Throwable $e) {
                flash()->addError(__('messages.neighborhood_delete_error'));
            }
        } else {
            flash()->addError(__('messages.neighborhood_delete_has_properties'));
        }

        return redirect()->back();
    }
}
