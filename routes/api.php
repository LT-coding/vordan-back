<?php

use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers')->group(function() {
    /**
     * API V1
     */
    require __DIR__ . '/api/v1/index.php';
});
