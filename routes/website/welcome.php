<?php


use App\Actions\Website\Welcome;

Route::get('/', Welcome::class)->name('home');
