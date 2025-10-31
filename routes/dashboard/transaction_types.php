<?php

use App\Actions\TransactionType\CreateTransactionType;
use App\Actions\TransactionType\DeleteTransactionType;
use App\Actions\TransactionType\GetTransactionTypes;
use App\Actions\TransactionType\UpdateTransactionType;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard/transaction-types', GetTransactionTypes::class)->name('transaction.type.all');
    Route::post('/dashboard/transaction-type', CreateTransactionType::class)->name('transaction.type.store');
    Route::match(['put', 'patch'], '/dashboard/transaction-type/{transactionType}', UpdateTransactionType::class)->name('transaction.type.update');
    Route::delete('/dashboard/transaction-type/{transactionType}', DeleteTransactionType::class)->name('transaction.type.delete');
});
