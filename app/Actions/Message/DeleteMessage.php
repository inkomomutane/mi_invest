<?php

namespace App\Actions\Message;

use App\Models\Agenda;

class DeleteMessage
{

    public function __invoke(Agenda $agenda)
    {
        try {
            $agenda->delete();
            flash()->addSuccess(__('messages.message_deleted_success'));
        } catch (\Throwable $th) {
            flash()->addError(__('messages.message_delete_error'));
        }

        return back();
    }
}
