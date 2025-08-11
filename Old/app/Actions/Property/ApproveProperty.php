<?php

namespace App\Actions\Property;

use App\Models\Property;
use Auth;
class ApproveProperty
{public function handle(Property $property): bool
    {
        try {
            $property->approved = true;
            $property->approved_by_id = Auth::user()->id;
            $property->approved_at = now();
            $property->save();

            return true;

        } catch (\Throwable $th) {

            return false;
        }

        return false;
    }
}
