<?php

namespace App\Console\Commands;

use App\Models\Property;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Vite;

class SitemapGeneratorCommand extends Command
{

    public $signature = 'sitemap:generate';

    protected $description = 'Generate website sitemap.';

    public function handle()
    {
        Sitemap::create(config('app.url'))
            ->add(Url::create(route('welcome'))->addImage(Vite::asset('resources/js/images/logo/logo.png')))
            ->add(Url::create(route('website.about'))->addImage(Vite::asset('resources/js/images/logo/logo.png')))
            ->add(Url::create(route('website.contact'))->addImage(Vite::asset('resources/js/images/logo/logo.png')))
            ->add(Url::create(route('website.policy'))->addImage(Vite::asset('resources/js/images/logo/logo.png')))
            ->add(Url::create(route('website.terms'))->addImage(Vite::asset('resources/js/images/logo/logo.png')))
            ->add(Property::all())
            ->add(Url::create(config('app.url').'/sitemap.xml'))
            ->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successful!');
    }
}
