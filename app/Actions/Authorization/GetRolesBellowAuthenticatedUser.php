<?php

namespace App\Actions\Authorization;

use App\Support\Enums\SystemRoles;
use Auth;
use Spatie\Permission\Models\Role;

class GetRolesBellowAuthenticatedUser
{

    public function handle()
    {
        $user = Auth::user();
        $roleMapping = [
            SystemRoles::SUPERADMIN => 1,
            SystemRoles::ADMIN => 2,
            SystemRoles::SUBADMIN => 3,
            SystemRoles::REALSTATEAGENCY => 4,
            SystemRoles::REALSTATEAGENT => 5,
        ];

        $minRoleId = $roleMapping[SystemRoles::REALSTATEAGENT];

        foreach ($roleMapping as $role => $minId) {
            if ($user?->hasRole($role)) {
                $minRoleId = $minId;
                break;
            }
        }

        return Role::where('id', '>', $minRoleId)->get();
    }
}
