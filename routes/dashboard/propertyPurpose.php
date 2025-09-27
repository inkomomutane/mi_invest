<?php 

use App\Actions\PropertyPurpose\CreatePropertyPurpose;
use App\Actions\PropertyPurpose\DeletePropertyPurpose;
use App\Actions\PropertyPurpose\GetPropertyPurposes;
use App\Actions\PropertyPurpose\UpdatePropertyPurpose;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard/property-purposes', GetPropertyPurposes::class)->name('property-purpose.all');
    Route::post('dashboard/property-purpose', CreatePropertyPurpose::class)->name('property-purpose.store');
    Route::match(['put', 'patch'], 'dashboard/property-purpose/{propertyPurpose}', UpdatePropertyPurpose::class)->name('property-purpose.update');
    Route::delete('dashboard/property-purpose/{propertyPurpose}', DeletePropertyPurpose::class)->name('property-purpose.delete');
});