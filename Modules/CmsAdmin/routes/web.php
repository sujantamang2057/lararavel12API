<?php

use Illuminate\Support\Facades\Route;
use Modules\CmsAdmin\Http\Controllers\CmsAdminController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('cmsadmin', CmsAdminController::class)->names('cmsadmin');
});
