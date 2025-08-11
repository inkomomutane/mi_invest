<?php

namespace App\Actions\Property\image;

use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DeletePropertyImages
{
    public function __invoke(Media $media)
    {
        try {
            $media->delete();
            flash()->addSuccess(__('messages.image_deleted_success'));
        } catch (\Throwable $th) {
            flash()->addError(__('messages.image_delete_error'));
        }

        return \redirect()->back();
    }
}
