<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {

    flash()->addSuccess('Welcome to the Dashboard!');

    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

foreach (new FilesystemIterator(__DIR__.'/dashboard') as $fileName) {
    require $fileName->getPathname();
}
