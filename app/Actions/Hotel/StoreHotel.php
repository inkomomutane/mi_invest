<?php

namespace App\Actions\Hotel;

use App\Models\Hotel;
use App\Models\HotelMetaData;
use DB;
use Illuminate\Http\Request;

class StoreHotel
{

    public function rules(): array
    {
        return [
            'title' => 'required|string|unique:hotel_meta_datas,title',
            'description' => 'string|nullable',
            'address' => 'string|nullable',
            'neighborhood_id' => 'required|numeric',
            'condition_id' => 'required|numeric',
            'tipo_de_property_id' => 'required|numeric',
            'status_id' => 'numeric|required',
        ];
    }

    public function __invoke(Request $actionRequest): \Illuminate\Http\RedirectResponse
    {

        try {

            DB::beginTransaction();

            $hotelData = HotelMetaData::create($actionRequest->validated());
            foreach ($actionRequest->rooms as $room) {

                $roomUpdated = Hotel::create(
                    [
                        'price' => $room['price'],
                        'title' => $room['title'],
                        'description' => $room['description'],
                        'email' => $room['email'],
                        'contact' => $room['contact'],
                        'hotel_meta_data_id' => $hotelData->id,
                    ]
                );

                if ($room['images'] && is_array($room['images'])) {
                    foreach ($room['images'] as $image) {
                        $roomUpdated->addMedia($image)->toMediaCollection('hotels', 'hotels');
                    }
                }

                if ($room['attributes'] && is_array($room['attributes'])) {
                    $roomUpdated->attributes()->sync($room['attributes']);
                }
            }

            DB::commit();

            flash()->addSuccess(__('messages.action_success'));

            return to_route('hotel.all');
        } catch (\Throwable $e) {
            throw $e;
            flash()->addError(__('messages.action_error'));
            return back();
        }
    }
}
