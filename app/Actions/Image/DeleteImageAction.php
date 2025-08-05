<?php

namespace App\Actions\Image;

use Exception;
use Illuminate\Http\RedirectResponse;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DeleteImageAction
{
    public function __invoke(Media $media): RedirectResponse
    {
        try {
            $media->delete();
            flash()->addSuccess(__('messages.image_deleted_success'));
            return redirect()->back();
        } catch (Exception) {
            flash()->addError(__('messages.image_delete_error'));
            return redirect()->back();
        }
    }
}
