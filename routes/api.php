<?php

use App\Http\Controllers\Api\PhoneController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/phones', [PhoneController::class, 'index']);
    Route::post('/phones', [PhoneController::class, 'store']);
    Route::get('/phones/{phone}', [PhoneController::class, 'show']);
    Route::put('/phones/{phone}', [PhoneController::class, 'update']);
    Route::delete('/phones/{phone}', [PhoneController::class, 'destroy']);
});
