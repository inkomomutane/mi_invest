<?php

namespace App\Actions\Website;

use RalphJSmit\Laravel\SEO\Support\SEOData;
use Vite;

class Contact
{

    public function __invoke()
    {
        return view('website.contact', [
            'seoData' => new SEOData(
                title: 'Contacte-nos',
                description: 'Contacte-nos',
                site_name: 'Contacte-nos',
                url: route('website.contact'),
                canonical_url: route('website.contact'),
                image: Vite::asset('resources/js/images/logo/logo.png'),
                favicon: Vite::asset('resources/js/images/logo/favicon.ico'),
            ),
        ]);
    }
}
