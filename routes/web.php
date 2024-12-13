<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;




Route::get('/', [LinkController::class, 'index']);
Route::post('/shorten', [LinkController::class, 'shorten'])->name('shorten');
Route::get('/{short_code}', [LinkController::class, 'redirect'])->name('redirect');
