<?php

use App\Http\Controllers\prodController;
use Illuminate\Support\Facades\Route;

Route::get('/',[prodController::class,'index'])->name('product.index');

Route::get('/create',[prodController::class,'create'])->name('product.create');

Route::post('/store',[prodController::class,'store'])->name('product.store');
