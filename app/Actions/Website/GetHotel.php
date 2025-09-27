<?php

namespace App\Actions\Website;

use App\Models\HotelMetaData;
use Illuminate\Contracts\View\View;

class GetHotel
{

    public function __invoke(HotelMetaData $hotel): View
    {
        return view('website.hotel', [
            'hotel' => $hotel->load('hotels.media'),
        ]);
    }
}
