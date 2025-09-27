<?php 

use App\Actions\IntermediationRule\CreateIntermediationRule;
use App\Actions\IntermediationRule\DeleteIntermediationRule;
use App\Actions\IntermediationRule\GetIntermediationRules;
use App\Actions\IntermediationRule\UpdateIntermediationRule;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard/intermediation-rules', GetIntermediationRules::class)->name('intermediation-rule.all');
    Route::post('dashboard/intermediation-rule', CreateIntermediationRule::class)->name('intermediation-rule.store');
    Route::match(['put', 'patch'], 'dashboard/intermediation-rule/{intermediationRule}', UpdateIntermediationRule::class)->name('intermediation-rule.update');
    Route::delete('dashboard/intermediation-rule/{intermediationRule}', DeleteIntermediationRule::class)->name('intermediation-rule.delete');
});