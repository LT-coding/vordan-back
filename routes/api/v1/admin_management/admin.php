<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Admin')
    ->prefix('admins')
    ->middleware(['auth:sanctum'])
    ->group(function() {
        Route::controller(AdminReadController::class)->group(function() {
            Route::get('/', 'index');
            Route::get('/{adminAccount}/edit', 'edit');
        });

        Route::controller(AdminWriteController::class)->group(function() {
            Route::post('/', 'store');
            Route::put('/{user}', 'update');
            Route::delete('/{user}', 'delete')->middleware(['role:admin']);
        });
    });
