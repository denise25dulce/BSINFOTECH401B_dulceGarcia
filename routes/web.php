<?php

use App\Http\Controllers\prodController;
use Illuminate\Support\Facades\Route;

Route::get('/',[prodController::class,'index'])->name('product.index');

Route::get('/create',[prodController::class,'create'])->name('product.create');

Route::post('/store',[prodController::class,'store'])->name('product.store');

Route::get('/{id}',[prodController::class,'show'])->name('product.show');

Route::get('/{id}/edit',[prodController::class,'edit'])->name('product.edit');

Route::put('/{id}',[prodController::class,'update'])->name('product.update');

Route::delete('/products/{id}', [prodController::class, 'destroy'])->name('product.destroy');