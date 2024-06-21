<?php

use Illuminate\Support\Facades\Route;

Route::namespace('RolePermission')
    ->prefix('role-permissions')
    ->middleware(['auth:sanctum'])
    ->group(function() {
        Route::controller(RoleReadController::class)->group(function() {
            Route::get('/', 'index')->middleware(['role:admin|manager']);
        });
    });
