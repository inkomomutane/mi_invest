<?php

namespace App\Actions\Website;

use App\Actions\Page\GetPage;
use App\Models\Banner;
use App\Models\HotelMetaData;
use App\Models\Property;
use App\Support\Enums\Pages;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Vite;

class Welcome
{

    public function __invoke()
    {
        $page = GetPage::run();

        return view('website.welcome', [
            'page' => GetPage::run()->with('media')->first()?->getFirstMedia(Pages::HOME),
            'hotels' => $this->getRelevantHotelsRooms(),
            'thumb' => GetPage::run()->with('media')->first()?->getFirstMedia(Pages::HOME)?->responsiveImages()?->getPlaceholderSvg(),
            'relevantProperties' => $this->getRelevantProperties(),
            'lastestProperties' => Property::withApproved()->with(['neighborhood.city', 'media', 'intermediationRule', 'propertyFor', 'tipo_de_property', 'status', 'comentarios', 'ratings'])->latest('created_at')->get()->take(10),
            'banners' => Banner::with('media')->first(),
            'logo' => GetPage::run()->with('media')->first()?->getFirstMedia(Pages::LOGO),
            'seoData' => new SEOData(
                title: $page->name,
                description: $page->content,
                image: Vite::asset('resources/js/images/logo/logo.png'),
                url: route('welcome'),
                site_name: 'Mimóvel',
                favicon: Vite::asset('resources/js/images/logo/favicon.ico'),
                canonical_url: route('welcome'),
            ),
            'properties_count' => Property::count(),
            'hotels_count' => HotelMetaData::whereHas('hotels')->count(),
        ]);
    }

    private function getRelevantHotelsRooms()
    {

        return HotelMetaData::with('hotels.media')->whereHas('hotels')->get();

    }

    private function getRelevantProperties()
    {
        return Property::withApproved()->with(['neighborhood.city', 'media', 'intermediationRule', 'propertyFor', 'tipo_de_property', 'status', 'comentarios', 'ratings'])->orderByUniqueViews()->get()->take(10);
    }
}
