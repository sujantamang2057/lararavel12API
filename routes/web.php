<?php

use App\Http\Controllers\PostCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('cmsadmin/post-category', PostCategoryController::class)->names([
    'index' => 'cmsadmin.postCategories.index',
    'store' => 'cmsadmin.postCategories.store',
    'show' => 'cmsadmin.postCategories.show',
    'update' => 'cmsadmin.postCategories.update',
    'destroy' => 'cmsadmin.postCategories.destroy',
    'create' => 'cmsadmin.postCategories.create',
    'edit' => 'cmsadmin.postCategories.edit',
]);
