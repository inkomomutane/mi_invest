<?php

namespace App\Actions\Media;

use App\Data\MediaData;
use App\Models\Banner;
use App\Support\Enums\SystemRoles;
use Inertia\Inertia;
use Illuminate\Http\Request;

class GetBanners
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
        if (Banner::first() == null) {
            Banner::create([]);
        }

        return MediaData::collect(
            Banner::first()->media()
                ->where('collection_name', 'banners')
                ->orderBy('updated_at', 'desc')
                ->paginate(3)
        );
    }

    public function __invoke()
    {
        return Inertia::render('Banner/Index', [
            'banners' => $this->handle(),
        ]);
    }
}
