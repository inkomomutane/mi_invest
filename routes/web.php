<?php
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('dashboard', static fn() => Inertia::render('Dashboard'))->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

foreach (new FilesystemIterator(__DIR__.'/dashboard') as $fileName) {
    require $fileName->getPathname();
}

foreach (new FilesystemIterator(__DIR__.'/website') as $fileName) {
    require $fileName->getPathname();
}

