<?php

namespace App\Actions\Legal;

use App\Models\Politica;
use App\Support\Enums\SystemRoles;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GetPolicy
{

    public function authorize(Request $request): bool
    {
        /** @var User $user */
        $user = $request->user();

        return $user->hasAnyRole(
            SystemRoles::SUPERADMIN,
            SystemRoles::ADMIN
        );
    }

    public function handle()
    {
        if (Politica::first() == null) {
            Politica::create([
                'politicas' => '',
            ]);
        }

        return Politica::first()->getData();
    }

    public function __invoke()
    {
        return Inertia::render('Legal/Policy', [
            'policy' => $this->handle(),
        ]);
    }
}
