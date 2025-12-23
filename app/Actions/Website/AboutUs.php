<?php

namespace App\Actions\Website;

use Inertia\Inertia;

class AboutUs
{
    public function __invoke()
    {
        return Inertia::render('Website/AboutUs');
    }
}
