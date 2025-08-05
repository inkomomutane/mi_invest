<?php

namespace App\Actions\Hotel\Rooms;

use App\Models\Hotel;
use App\Models\HotelMetaData;
use Google\Exception;
use Illuminate\Http\Request;

class AttachRoomToHotel
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:125'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric']
        ];
    }

    public function __invoke(HotelMetaData $hotel, Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate($this->rules());

        try {
            $room = $hotel->hotels()->create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'price' => $validated['price']
            ]);
            $room = Hotel::whereId($room->id)->first();

            if ($request['images'] && is_array($request['images'])) {
                foreach ($request['images'] as $image) {
                    $room->addMedia($image)->toMediaCollection('hotels', 'hotels');
                }
            }

            flash()->addSuccess(__('messages.room_attached_success'));
            return redirect()->back();
        } catch (Exception) {
            flash()->addError(__('messages.room_attach_error'));
            return redirect()->back();
        }
    }
}
