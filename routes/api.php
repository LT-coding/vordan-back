<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\Api')->group(function() {
    /**
     * API V1
     */
    require __DIR__ . '/api/v1/index.php';

    Route::get('user', function(Request $request) {
        return new \App\Http\Resources\AdminManagement\Admin\AdminIndexResource($request->user('sanctum'));
    });
});
