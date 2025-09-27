<?php 

use App\Actions\Condition\CreateCondition;
use App\Actions\Condition\DeleteCondition;
use App\Actions\Condition\GetConditions;
use App\Actions\Condition\UpdateCondition;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard/conditions', GetConditions::class)->name('condition.all');
    Route::post('dashboard/condition', CreateCondition::class)->name('condition.store');
    Route::match(['put', 'patch'], 'dashboard/condition/{condition}', UpdateCondition::class)->name('condition.update');
    Route::delete('dashboard/condition/{condition}', DeleteCondition::class)->name('condition.delete');
});
