<?php

namespace App\Actions\Hotel;

use App\Models\HotelMetaData;
class DeleteHotel
{public function handle(HotelMetaData $hotel): bool
    {
        try {
            $hotel->delete();

            return true;
        } catch (\Exception $exception) {
            //            throw  $exception;
            return false;
        }
    }

    public function asController(HotelMetaData $hotel): \Illuminate\Http\RedirectResponse
    {
        if ($this->handle($hotel)) {
            flash()->addSuccess(__('messages.hotel_deleted_success'));

            return redirect()->back();
        }
        flash()->addError(__('messages.hotel_delete_error'));

        return redirect()->back();
    }
}
