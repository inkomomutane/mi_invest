<?php

namespace App\Actions\User;

use App\Models\User;

class UserTreeInIdArray
{

    public static function handle(User $user): array
    {
        return User::whereDescendantOf(id: $user->id, andSelf: true)->get()->pluck('id')->toArray();
    }
}
