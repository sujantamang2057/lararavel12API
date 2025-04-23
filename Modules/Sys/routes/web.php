<?php

use Illuminate\Support\Facades\Route;
use Modules\Sys\app\Http\Controllers\DashboardController;

Route::get('/sys', [DashboardController::class, 'index'])->name('sys.dashboards.index');
Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
