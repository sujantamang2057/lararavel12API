<?php

use Illuminate\Support\Facades\Route;
use Modules\CmsAdmin\Http\Controllers\CmsAdminController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('cmsadmin', CmsAdminController::class)->names('cmsadmin');
});
