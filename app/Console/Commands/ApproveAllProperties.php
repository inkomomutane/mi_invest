<?php

namespace App\Console\Commands;


use App\Enums\SystemRoles;
use App\Models\Property;
use App\Models\User;
use Illuminate\Console\Command;

class ApproveAllProperties extends Command
{


    public  $signature = 'property:approve';
    protected $description = 'Approve all properties using super-admin role-permission.';

    public function authorize(User $user): bool
    {
        return $user->hasAnyRole(
            SystemRoles::SUPERADMIN,
            SystemRoles::ADMIN,
            SystemRoles::SUB_ADMIN
        );
    }

    public function handle(User $user)
    {
         abort_if(!$this->authorize($user),401);

        Property::withoutApproved()->update([
            'approved' => true,
            'approved_at' => now(),
            'approved_by_id' => 1,
        ]);
        $this->info('All properties are approved by administrator.');
    }
}
