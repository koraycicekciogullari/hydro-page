<?php

use Illuminate\Support\Facades\Route;
use Koraycicekciogullari\HydroPage\Controllers\PageController;
use Koraycicekciogullari\HydroPage\Controllers\PageGalleryController;
use Koraycicekciogullari\HydroPage\Controllers\PageOrderController;

Route::middleware(['auth:sanctum', 'api'])->prefix('api/admin')->group(function(){
    Route::apiResource('page', PageController::class)->except('edit', 'create');
    Route::apiResource('page-gallery', PageGalleryController::class)->only('update', 'destroy');
    Route::post('page-order', PageOrderController::class);
});
