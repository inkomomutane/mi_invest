<?php

namespace App\Actions\Hotel\Rooms;

use App\Models\Hotel;
use Exception;
use Illuminate\Http\Request;

class UpdateRoomOfHotel
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:125'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric']
        ];
    }

    public function __invoke(Hotel $room, Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate($this->rules());

        try {
            $room->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'price' => $validated['price']
            ]);

            if ($request['images'] && is_array($request['images'])) {
                foreach ($request['images'] as $image) {
                    $room->addMedia($image)->toMediaCollection('hotels', 'hotels');
                }
            }

            flash()->addSuccess(__('messages.room_updated_success'));
            return redirect()->back();
        } catch (Exception) {
            flash()->addError(__('messages.room_update_error'));
            return redirect()->back();
        }
    }
}
