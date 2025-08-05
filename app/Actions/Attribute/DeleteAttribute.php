<?php

namespace App\Actions\Attribute;

use App\Models\Attribute;
use Illuminate\Http\Request;

class DeleteAttribute
{
    public function __invoke(Attribute $attribute, Request $request)
    {
        if ($attribute->hotels->isEmpty()) {
            try {
                $attribute->delete();
                flash()->addSuccess(__('messages.attribute_deleted_success'));
            } catch (\Throwable $e) {
                flash()->addError(__('messages.attribute_delete_error'));
            }
        } else {
            flash()->addError(__('messages.attribute_delete_has_hotels'));
        }

        return redirect()->back();
    }
}
