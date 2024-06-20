<?php

use App\Http\Controllers\Api\DashboardControllerApi;
use App\Http\Controllers\Dasboard\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// admin
Route::get('/admin', [DashboardControllerApi::class, 'index']);
