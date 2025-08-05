<?php

namespace App\Actions\Media;

use App\Support\Enums\SystemRoles;
use Illuminate\Http\Request;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DeleteBanners
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

    public function __invoke(Media $media)
    {
        try {
            $media->delete();
            flash()->addSuccess(__('messages.banner_deleted_success'));
        } catch (\Throwable $th) {
            flash()->addError(__('messages.banner_delete_error'));
        }

        return redirect()->back();
    }
}
