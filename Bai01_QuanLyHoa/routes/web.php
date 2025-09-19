<?php

use App\Http\Controllers\FlowerController;

// Flower Management Routes
Route::get('/', [FlowerController::class, 'guest'])->name('flowers.guest');
Route::get('/flowers/guest', [FlowerController::class, 'guest'])->name('flowers.guest');
Route::get('/flowers/admin', [FlowerController::class, 'admin'])->name('flowers.admin');
Route::get('/flowers/create', [FlowerController::class, 'create'])->name('flowers.create');
Route::post('/flowers', [FlowerController::class, 'store'])->name('flowers.store');
Route::get('/flowers/{id}/edit', [FlowerController::class, 'edit'])->name('flowers.edit');
Route::put('/flowers/{id}', [FlowerController::class, 'update'])->name('flowers.update');
Route::delete('/flowers/{id}', [FlowerController::class, 'destroy'])->name('flowers.destroy');