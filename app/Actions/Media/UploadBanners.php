<?php

namespace App\Actions\Media;

use App\Models\Banner;
use App\Support\Enums\SystemRoles;
use Illuminate\Http\Request;

class UploadBanners
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

    public function rules(): array
    {
        return [
            'images' => 'required',
            'images.*' => 'required|image|max:15360',
        ];
    }

    public function __invoke(Request $actionRequest)
    {
        $banner = Banner::first();

        try {

            if ($actionRequest->file('images')) {

                foreach ($actionRequest->file('images') as $key => $file) {
                    $banner->addMedia($file)
                        ->withResponsiveImages()
                        ->toMediaCollection('banners', 'banners');
                }
            }

            flash()->addSuccess(__('messages.image_uploaded_success'));
        } catch (\Throwable $th) {
            flash()->addError(__('messages.image_upload_error'));
        }

        return \redirect()->back();
    }
}
