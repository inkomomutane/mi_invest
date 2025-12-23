<?php

namespace App\Actions\Website;

use Illuminate\Http\Request;
use Inertia\Inertia;

class GetProperties
{

    public function handle(Request $actionRequest)
    {

    }

    public function __invoke(Request $actionRequest)
    {
        return Inertia::render('Website/Properties');
    }
}
