<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CbtController;
use App\Http\Controllers\RemoteApiController;

// Endpoint ini akan dipanggil oleh Frontend/System untuk mengubah password CBT client


// K-Host Endpoint
Route::post('/system/remote-reset-admin', [RemoteApiController::class, 'forceResetAdmin']);
Route::middleware('auth:sanctum')->post('/cbt/change-password', [CbtController::class, 'updateCbtAdminPassword']);