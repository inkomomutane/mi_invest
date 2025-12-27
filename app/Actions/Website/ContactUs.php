<?php

namespace App\Actions\Website;

use Inertia\Inertia;

class ContactUs
{
    public function __invoke()
    {
        return Inertia::render('Website/ContactUs');
    }
}
