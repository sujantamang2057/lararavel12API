<?php

use Illuminate\Support\Facades\Route;
use Modules\Cms\Http\Controllers\Api\BannerController;
use Modules\Cms\Http\Controllers\Api\AlbumController;

use Modules\Cms\Http\Controllers\Api\NewsCategoryController;

Route::prefix('cms')->group(function () {
    
    // banners
Route::get('banners/trash-list', [BannerController::class, 'trashList'])->name('cms.banners.trashList');
Route::apiResource('banners', BannerController::class)->names('cms.banners');

// albums
Route::apiResource('albums', AlbumController::class)->names('cms.albums');


// news-categories
Route::get('news-categories/trash-list', [NewsCategoryController::class, 'trashList'])->name('cms.news-categories.trashList');

Route::apiResource('news-categories', NewsCategoryController::class)->names('cms.news-categories');

});



