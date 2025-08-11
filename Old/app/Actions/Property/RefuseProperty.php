<?php

namespace App\Actions\Property;

use App\Models\Property;
class RefuseProperty
{public function handle(Property $property): bool
    {
        try {
            $property->delete();

            return true;
        } catch (\Throwable $th) {
            return false;
        }

        return false;
    }
}
