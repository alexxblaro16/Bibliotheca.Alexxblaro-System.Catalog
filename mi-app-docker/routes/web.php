<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowBookController;
use Illuminate\Support\Facades\Route;

// Rutas del catálogo
Route::resource('books', BookController::class);

// Ruta de préstamos (Apunta al nuevo controlador BorrowBookController)
Route::post('/borrow/{user_id}/{book_id}', [BorrowBookController::class, 'store'])->name('borrow.store');
Route::get('/inventory/{user_id}', [BorrowBookController::class, 'inventory'])->name('borrow.inventory');