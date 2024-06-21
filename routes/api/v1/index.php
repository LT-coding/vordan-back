<?php

use Illuminate\Support\Facades\Route;

Route::namespace('V1')->prefix('v1')->group(function() {
    Route::namespace('AdminManagement')->prefix('adm')->group(function() {
        require __DIR__ . '/admin_management/admin.php';
        require __DIR__ . '/admin_management/role_permission.php';
    });
});
