<?php

use App\Actions\Province\GetProvinces;
use App\Actions\Province\CreateProvince;
use App\Actions\Province\GetProvincesJson;
use App\Actions\Province\UpdateProvince;
use App\Actions\Province\DeleteProvince;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard/provinces', GetProvinces::class)->name('province.all');
    Route::get('dashboard/provinces/json', GetProvincesJson::class)->name('provinces-json');
    Route::post('dashboard/province', CreateProvince::class)->name('province.store');
    Route::match(['put', 'patch'], 'dashboard/province/{province}', UpdateProvince::class)->name('province.update');
    Route::delete('dashboard/province/{province}', DeleteProvince::class)->name('province.delete');
});
