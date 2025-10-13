<?php

use App\Actions\BusinessRule\CreateBusinessRule;
use App\Actions\BusinessRule\DeleteBusinessRule;
use App\Actions\BusinessRule\GetBusinessRules;
use App\Actions\BusinessRule\UpdateBusinessRule;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard/business-rules', GetBusinessRules::class)->name('business-rule.all');
    Route::post('dashboard/business-rule', CreateBusinessRule::class)->name('business-rule.store');
    Route::match(['put', 'patch'], 'dashboard/business-rule/{businessRule}', UpdateBusinessRule::class)->name('business-rule.update');
    Route::delete('dashboard/business-rule/{businessRule}', DeleteBusinessRule::class)->name('business-rule.delete');
});
