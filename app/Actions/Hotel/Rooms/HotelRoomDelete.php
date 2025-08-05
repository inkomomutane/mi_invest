<?php

namespace App\Actions\Hotel\Rooms;

use App\Models\Hotel;
use Illuminate\Http\RedirectResponse;

class HotelRoomDelete
{
    public function __invoke(Hotel $room): RedirectResponse
    {
        if ($this->handle($room)) {
            flash()->addSuccess(__('messages.room_deleted_success'));
        } else {
            flash()->addError(__('messages.room_delete_error'));
        }

        return redirect()->back();
    }

    public function handle(Hotel $room): bool
    {
        try {
            $room->delete();
            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }
}

