<?php


use App\Actions\Website\AboutUs;
use App\Actions\Website\GetProperties;
use App\Actions\Website\ViewProperty;
use App\Actions\Website\Welcome;

Route::get('/', Welcome::class)->name('home');
Route::get('/view/property',ViewProperty::class)->name('view-property');
Route::get('/about-us',AboutUs::class)->name('about-us');
Route::get('/properties', GetProperties::class)->name('properties');
