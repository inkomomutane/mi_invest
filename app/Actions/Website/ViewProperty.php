<?php

namespace App\Actions\Website;

use Inertia\Inertia;

class ViewProperty
{
    public function __invoke()
    {
        return Inertia::render('Website/ViewProperty');
    }
}
