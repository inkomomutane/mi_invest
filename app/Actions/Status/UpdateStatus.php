<?php

namespace App\Actions\Status;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateStatus
{


    public function __invoke(Request $request, Status $status)
    {
        $validated = $request->validate([
            'name' => ['required', Rule::unique(Status::class, 'name')->ignore($status->id, 'id')],
        ]);

        try {
            $status->name = $validated['name'];
            $status->save();
            flash()->addSuccess(__('messages.status_updated_success'));
        } catch (\Throwable $th) {
            flash()->addError(__('messages.action_error'));
        }

        return \redirect()->back();
    }
}
