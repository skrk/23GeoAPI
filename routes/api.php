<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CountryController;
use App\Http\Controllers\Api\V1\CityController;

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

// Get Cities By Country
Route::get('/countries/{country}/cities', [CityController::class, 'index']);

// Create City By Country
Route::post('/countries/{country}/cities', [CityController::class, 'store']);

// CRUD For Countries
Route::apiResource('countries', CountryController::class);

// Get All Cities
Route::get('/cities/{city}', [CityController::class, 'show']);

//Update City By ID
Route::match(['put', 'patch'],'/cities/{city}', [CityController::class, 'update']);

//Delete City By ID
Route::delete('/cities/{city}', [CityController::class, 'destroy']);

// Default 404 Route
Route::any('{any}', function(){
    return response()->json([
        'status'    => false,
        'message'   => 'API resource not found',
    ], 404);
})->where('any', '.*');