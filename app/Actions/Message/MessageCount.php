<?php

namespace App\Actions\Message;

use App\Models\Schedule;
use App\Models\User;
use Auth;

class MessageCount
{public function handle(): int
    {
        /** @var User $user */
        $user = Auth::user();
        if (is_null($user)) {
            return 0;
        }
        if ($user->hasAnyRole('Admin', 'Super-Admin')) {
            return Schedule::whereIsReaded(false)->count();
        }

        return Schedule::whereCorretorId($user->id)->whereIsReaded(false)->count();
    }
}
