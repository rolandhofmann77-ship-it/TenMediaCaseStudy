<?php

use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\CompanyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//route to get ALL jobs with their associated company and creator (user) information
//no authentication required for this route
Route::get('jobs', [JobController::class, 'index']);

//route to get a SPECIFIC job with its associated company and creator (user) information
//no authentication required for this route
Route::get('jobs/{id}', [JobController::class, 'show']);

//route to create a new job listing for the authenticated user
//authentication required for this route
Route::post('jobs', [JobController::class, 'store'])->middleware('auth:sanctum');

//route to update an existing job listing for the authenticated user(creator)
//authentication required for this route
//ToDo: patch method instead of put method?
Route::put('jobs/{id}', [JobController::class, 'update'])->middleware('auth:sanctum');

//route to destroy an existing job listing for the authenticated user(creator)
//authentication required for this route
Route::delete('jobs/{id}', [JobController::class, 'destroy'])->middleware('auth:sanctum');

//route to get all companies with their associated users
Route::get('companies', [CompanyController::class, 'index']);

//route to get a specific company with its associated users
Route::get('companies/{id}', [CompanyController::class, 'show']);

//route to create a new company for the authenticated user
//authentication required for this route
Route::post('companies', [CompanyController::class, 'store'])->middleware('auth:sanctum');

//update an existing company for the authenticated user
//authentication required for this route
Route::put('companies/{id}', [CompanyController::class, 'update'])->middleware('auth:sanctum');

//route to destroy an existing company for the authenticated user
//authentication required for this route
Route::delete('companies/{id}', [CompanyController::class, 'destroy'])->middleware('auth:sanctum');
