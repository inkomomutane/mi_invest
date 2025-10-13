<?php

namespace App\Actions\Website;

use App\Actions\Page\GetPage;
use Inertia\Inertia;

class Welcome
{

    public function __invoke()
    {
        #$page = GetPage::run();

        return  Inertia::render('Website/Welcome');
    }

}
