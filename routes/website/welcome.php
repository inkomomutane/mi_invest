<?php


use App\Actions\Website\ViewProperty;
use App\Actions\Website\Welcome;

Route::get('/', Welcome::class)->name('home');
Route::get('/view/property',ViewProperty::class)->name('view-property');
