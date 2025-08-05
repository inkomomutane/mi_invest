<?php

namespace App\Actions\Legal;

use App\Models\Termo;
use App\Support\Enums\SystemRoles;
use Inertia\Inertia;
use Illuminate\Http\Request;

class GetTermAndCondition
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
        if (Termo::first() == null) {
            Termo::create([
                'termos' => '',
            ]);
        }

        return Termo::first()->getData();
    }

    public function __invoke()
    {
        return Inertia::render('Legal/Terms', [
            'term' => $this->handle(),
        ]);
    }
}
