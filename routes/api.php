<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CbtController;

// Endpoint ini akan dipanggil oleh Frontend/System untuk mengubah password CBT client
Route::middleware('auth:sanctum')->post('/cbt/change-password', [CbtController::class, 'updateCbtAdminPassword']);