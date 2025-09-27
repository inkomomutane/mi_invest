<?php

namespace App\Actions\Page;

use App\Models\Page;
use App\Support\Enums\SystemRoles;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GetPage
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

    public function handle(): Page
    {
        /** @var Page $page */
        $page = Page::first() ?? Page::create([]);

        return $page;
    }

    public function __invoke()
    {
        return Inertia::render('Page/Index', [
            'pageData' => $this->handle()->load('media')->getData(),
        ]);
    }
}
