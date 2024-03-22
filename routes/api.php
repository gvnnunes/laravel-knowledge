<?php

use App\Http\Controllers\Api\ApiEventCategoryController;
use App\Http\Controllers\Api\ApiEventController;
use App\Http\Controllers\Api\ApiParticipantController;
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

Route::prefix('event-categories')->name('event-categories.')->group(function () {
    Route::get('/', [ApiEventCategoryController::class, 'index'])->name('index');
    Route::get('/{eventCategory}', [ApiEventCategoryController::class, 'show'])->name('show');
    Route::post('/', [ApiEventCategoryController::class, 'store'])->name('store');
    Route::put('/{eventCategory}', [ApiEventCategoryController::class, 'update'])->name('update');
    Route::delete('/{eventCategory}', [ApiEventCategoryController::class, 'destroy'])->name('destroy');
});

Route::prefix('participants')->name('participants.')->group(function () {
    Route::get('/', [ApiParticipantController::class, 'index'])->name('index');
    Route::get('/{participant}', [ApiParticipantController::class, 'show'])->name('show');
    Route::post('/', [ApiParticipantController::class, 'store'])->name('store');
    Route::put('/{participant}', [ApiParticipantController::class, 'update'])->name('update');
    Route::delete('/{participant}', [ApiParticipantController::class, 'destroy'])->name('destroy');
});
