<?php

use App\Models\vehiculos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\vehiculoController;
use function Ramsey\Uuid\v1;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1/vehiculos')->group(function(){
    Route::get('/', [vehiculoController::class,'get']);
    Route::post('/', [vehiculoController::class,'create']);
    Route::get('/{id}', [vehiculoController::class,'getById']);
    Route::put('/{id}', [vehiculoController::class,'update']);
    Route::delete('/{id}', [vehiculoController::class,'delete']);
});
/*cesarP*/