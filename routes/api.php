<?php

use App\Http\Controllers\Api\ApiEventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('events')->name('events.')->group(function () {
    Route::get('/', [ApiEventController::class, 'index'])->name('index');
    Route::get('/{event}', [ApiEventController::class, 'show'])->name('show');
    Route::post('/', [ApiEventController::class, 'store'])->name('store');
    Route::put('/{event}', [ApiEventController::class, 'update'])->name('update');
    Route::delete('/{event}', [ApiEventController::class, 'destroy'])->name('destroy');
});
