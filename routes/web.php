<?php

use App\Http\Controllers\SalesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SalesController::class, 'index'])->name('sales');
Route::get('/sales', [SalesController::class, 'allSales'])->name('all-sales');
Route::get('/fetch-sales', [SalesController::class, 'fetchSales']);

Route::post('/sales/store', [SalesController::class, 'store']);
