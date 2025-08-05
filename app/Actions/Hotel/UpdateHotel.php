<?php

namespace App\Actions\Hotel;

use App\Models\Hotel;
use App\Models\HotelMetaData;
use DB;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UpdateHotel
{

    public function __invoke(HotelMetaData $hotel, Request $actionRequest): \Illuminate\Http\RedirectResponse
    {
        $validated = request()?->validate([
            'nome' => ['required|string', Rule::unique(HotelMetaData::class, 'title')->ignore($hotel->id, 'id')],
            'description' => 'string|nullable',
            'address' => 'string|nullable',
            'neighborhood_id' => 'required|numeric',
            'condition_id' => 'required|numeric',
            'tipo_de_property_id' => 'required|numeric',
            'status_id' => 'numeric|required',
        ]);
        try {
            DB::beginTransaction();
            $hotel->update($validated);
            if ($actionRequest['images'] && is_array($actionRequest['images'])) {
                foreach ($actionRequest['images'] as $image) {
                    $hotel->addMedia($image)->toMediaCollection('main_hotels', 'hotels');
                }
            }

            if ($actionRequest['attributes'] && is_array($actionRequest['attributes'])) {
                $hotel->attributes()->sync($actionRequest['attributes']);
            }

            DB::commit();
            flash()->addSuccess(__('messages.hotel_updated_success'));
            return to_route('hotel.all');
        } catch (\Throwable $e) {
            throw $e;
            flash()->addError(__('messages.action_error'));
            return back();
        }
    }
}
