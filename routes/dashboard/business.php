<?php

use App\Actions\RegraDeBusinessRule\CreateRegraDeBusinessRule;
use App\Actions\RegraDeBusinessRule\DeleteRegraDeBusinessRule;
use App\Actions\RegraDeBusinessRule\GetRegrasDeBusinessRule;
use App\Actions\RegraDeBusinessRule\UpdateRegraDeBusinessRule;

Route::middleware(['roles:Admin|Super-Admin', 'auth', 'verified'])->group(function () {
    Route::get('/dashboard/businesss', GetRegrasDeBusinessRule::class)->name('business.all');
    Route::post('/dashboard/business', CreateRegraDeBusinessRule::class)->name('business.store');
    Route::match(['put', 'patch'], '/dashboard/business/{businessRule}', UpdateRegraDeBusinessRule::class)->name('business.update');
    Route::delete('/dashboard/business/{businessRule}', DeleteRegraDeBusinessRule::class)->name('business.delete');
});
