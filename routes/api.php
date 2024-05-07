<?php

use App\Http\Controllers\Api\ApiEventCategoryController;
use App\Http\Controllers\Api\ApiEventController;
use App\Http\Controllers\Api\ApiParticipantController;
use App\Http\Controllers\Api\ApiSpeakerController;
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

Route::name('api.')->group(function () {
    Route::prefix('events')->name('events.')->group(function () {
        Route::get('/', [ApiEventController::class, 'index'])->name('index');
        Route::get('/{event}', [ApiEventController::class, 'show'])->name('show');
        Route::post('/', [ApiEventController::class, 'store'])->name('store');
        Route::put('/{event}', [ApiEventController::class, 'update'])->name('update');
        Route::delete('/{event}', [ApiEventController::class, 'destroy'])->name('destroy');
        Route::post('/{event}/participants/{participant}', [ApiEventController::class, 'storeParticipant'])->name('participants.store');
        Route::post('/{event}/speakers/{speaker}', [ApiEventController::class, 'storeSpeaker'])->name('speakers.store');
        Route::post('/{event}/event-categories/{eventCategory}', [ApiEventController::class, 'storeEventCategory'])->name('event-categories.store');
        Route::delete('/{event}/participants/{participant}', [ApiEventController::class, 'destroyParticipant'])->name('participants.destroy');
        Route::delete('/{event}/speakers/{speaker}', [ApiEventController::class, 'destroySpeaker'])->name('speakers.destroy');
        Route::delete('/{event}/event-categories/{eventCategory}', [ApiEventController::class, 'destroyEventCategory'])->name('event-categories.destroy');
    });

    Route::prefix('participants')->name('participants.')->group(function () {
        Route::get('/', [ApiParticipantController::class, 'index'])->name('index');
        Route::get('/{participant}', [ApiParticipantController::class, 'show'])->name('show');
        Route::post('/', [ApiParticipantController::class, 'store'])->name('store');
        Route::put('/{participant}', [ApiParticipantController::class, 'update'])->name('update');
        Route::delete('/{participant}', [ApiParticipantController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('speakers')->name('speakers.')->group(function () {
        Route::get('/', [ApiSpeakerController::class, 'index'])->name('index');
        Route::get('/{speaker}', [ApiSpeakerController::class, 'show'])->name('show');
        Route::post('/', [ApiSpeakerController::class, 'store'])->name('store');
        Route::put('/{speaker}', [ApiSpeakerController::class, 'update'])->name('update');
        Route::delete('/{speaker}', [ApiSpeakerController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('event-categories')->name('event-categories.')->group(function () {
        Route::get('/', [ApiEventCategoryController::class, 'index'])->name('index');
        Route::get('/{eventCategory}', [ApiEventCategoryController::class, 'show'])->name('show');
        Route::post('/', [ApiEventCategoryController::class, 'store'])->name('store');
        Route::put('/{eventCategory}', [ApiEventCategoryController::class, 'update'])->name('update');
        Route::delete('/{eventCategory}', [ApiEventCategoryController::class, 'destroy'])->name('destroy');
    });
});
