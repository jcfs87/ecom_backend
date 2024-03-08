<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\ValoracionController;
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
// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('logout', [LogoutController::class, 'logout']);
// });
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/login', [LoginController::class, 'loginCheck']);
Route::get('/listValoraciones', [ValoracionController::class, 'index']);
Route::get('/listPublicaciones', [PublicacionController::class, 'index']);
Route::get('/valoracion/{id}', [ValoracionController::class, 'getRatingSum']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('logout', [LogoutController::class, 'logout']);
});
