<?php

use App\Http\Controllers\Api\JobController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//route to get all jobs with their associated company and creator (user) information
//no authentication required for this route
Route::get('jobs', [JobController::class, 'index']);
