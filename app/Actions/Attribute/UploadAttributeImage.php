<?php

namespace App\Actions\Attribute;

use App\Models\Attribute;
use App\Support\Enums\SystemRoles;
use Illuminate\Http\Request;

class UploadAttributeImage
{
    public function __invoke(Attribute $attribute, Request $request): \Illuminate\Http\RedirectResponse
    {
        /** @var User $user */
        $user = $request->user();

        if (!$user->hasAnyRole(SystemRoles::SUPERADMIN, SystemRoles::ADMIN)) {
            abort(403);
        }

        $request->validate([
            'image' => 'required',
        ]);

        try {
            if ($request->hasFile('image') && count($request->image) > 0) {
                $attribute->addMedia($request->image[0])
                    ->withResponsiveImages()
                    ->toMediaCollection('attributes', 'attributes');
            }

            flash()->addSuccess(__('messages.image_uploaded_success'));
        } catch (\Throwable $th) {
            flash()->addError(__('messages.image_upload_error'));
        }

        return \redirect()->back();
    }
}
