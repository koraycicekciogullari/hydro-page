<?php

use Illuminate\Support\Facades\Route;
use Koraycicekciogullari\HydroPage\Controllers\PageController;
use Koraycicekciogullari\HydroPage\Controllers\PageOrderController;

Route::middleware(['auth:sanctum', 'api'])->prefix('api/admin')->group(function(){
    Route::apiResource('page', PageController::class)->except('edit', 'create');
    Route::post('page-order', PageOrderController::class);
});
