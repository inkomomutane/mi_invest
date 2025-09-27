<?php

use App\Actions\BusinessRule\CreateBusinessRule;
use App\Actions\BusinessRule\DeleteBusinessRule;
use App\Actions\BusinessRule\GetBusinessRules;
use App\Actions\BusinessRule\UpdateBusinessRule;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard/business-rules', GetBusinessRules::class)->name('businessrule.all');
    Route::post('dashboard/business-rule', CreateBusinessRule::class)->name('businessrule.store');
    Route::match(['put', 'patch'], 'dashboard/business-rule/{businessRule}', UpdateBusinessRule::class)->name('businessrule.update');
    Route::delete('dashboard/business-rule/{businessRule}', DeleteBusinessRule::class)->name('businessrule.delete');
});