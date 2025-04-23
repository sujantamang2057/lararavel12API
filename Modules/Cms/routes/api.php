<?php

use Illuminate\Support\Facades\Route;
use Modules\Cms\app\Http\Controllers\Api\BannerController;

Route::prefix('cms')->group(function () {

Route::apiResource('banners', BannerController::class)->names('cms.banners');
});

