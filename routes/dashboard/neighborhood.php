<?php

use App\Actions\Neighborhood\CreateNeighborhood;
use App\Actions\Neighborhood\DeleteNeighborhood;
use App\Actions\Neighborhood\GetNeighborhoods;
use App\Actions\Neighborhood\UpdateNeighborhood;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard/neighborhoods', GetNeighborhoods::class)->name('neighborhood.all');
    Route::post('/dashboard/neighborhood', CreateNeighborhood::class)->name('neighborhood.store');
    Route::match(['put', 'patch'], '/dashboard/neighborhood/{neighborhood}', UpdateNeighborhood::class)->name('neighborhood.update');
    Route::delete('/dashboard/neighborhood/{neighborhood}', DeleteNeighborhood::class)->name('neighborhood.delete');
});
