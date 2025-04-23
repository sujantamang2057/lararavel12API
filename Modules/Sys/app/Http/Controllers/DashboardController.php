<?php

namespace Modules\Sys\app\Http\Controllers;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sys::dashboard.index');
    }
}
