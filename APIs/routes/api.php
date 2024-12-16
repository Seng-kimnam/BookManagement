<?php

use App\Http\Controllers\AdminJSONController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::apiResource('api', AdminJSONController::class);

Route::post('/AdminList', [AdminJSONController::class, 'store']);

