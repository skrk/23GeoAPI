<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CountryController;
use App\Http\Controllers\Api\V1\CityController;
use App\Http\Controllers\Api\V1\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Setup new user and get token
Route::get('/setup', [UserController::class, 'getToken']);

// Get Cities By Country
Route::get('/countries/{country}/cities', [CityController::class, 'index'])->middleware('auth:sanctum');

// Create City By Country
Route::post('/countries/{country}/cities', [CityController::class, 'store'])->middleware('auth:sanctum');

// CRUD For Countries
Route::apiResource('countries', CountryController::class)->middleware('auth:sanctum');

// Get All Cities
Route::get('/cities/{city}', [CityController::class, 'show'])->middleware('auth:sanctum');

//Update City By ID
Route::match(['put', 'patch'],'/cities/{city}', [CityController::class, 'update'])->middleware('auth:sanctum');

//Delete City By ID
Route::delete('/cities/{city}', [CityController::class, 'destroy'])->middleware('auth:sanctum');

// Default 404 Route
Route::any('{any}', function(){
    return response()->json([
        'status'    => false,
        'message'   => 'API resource not found',
    ], 404);
})->where('any', '.*');