<?php

use App\Actions\PropertyType\CreatePropertyType;
use App\Actions\PropertyType\DeletePropertyType;
use App\Actions\PropertyType\GetPropertyTypes;
use App\Actions\PropertyType\UpdatePropertyType;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard/property-types', GetPropertyTypes::class)->name('propertytype.all');
    Route::post('dashboard/property-type', CreatePropertyType::class)->name('propertytype.store');
    Route::match(['put', 'patch'], 'dashboard/property-type/{propertyType}', UpdatePropertyType::class)->name('propertytype.update');
    Route::delete('dashboard/property-type/{propertyType}', DeletePropertyType::class)->name('propertytype.delete');
});