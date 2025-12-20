<?php


use App\Actions\Icon\IconSetSelect;

Route::get('icon-set-list', IconSetSelect::class)->name('icon-set-list');
