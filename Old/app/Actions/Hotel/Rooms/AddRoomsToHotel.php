<?php

namespace App\Actions\Hotel\Rooms;

use App\Models\HotelMetaData;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Spatie\LaravelData\Exceptions\InvalidDataClass;

class AddRoomsToHotel
{
    /**
     * @throws InvalidDataClass
     */
    public function __invoke(HotelMetaData $hotel, Request $request): \Inertia\Response
    {
        return Inertia::render('Hotel/Room/AddRoomsToHotel', [
            'hotel' => $hotel->load(['hotels', 'media'])->getData()
        ]);
    }
}
