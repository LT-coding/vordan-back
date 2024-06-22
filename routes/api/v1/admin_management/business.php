<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Business')
    ->prefix('businesses')
    ->middleware(['auth:sanctum', 'role:admin|manager'])
    ->group(function() {
        Route::controller(BusinessReadController::class)->group(function() {
            Route::get('/', 'index');
        });

        Route::controller(BusinessVerificationWriteController::class)->group(function() {
            Route::post('/{business}/verify', 'verification');
        });

        Route::controller(BusinessWriteController::class)->group(function() {
            Route::post('/', 'store');
        });
    });
