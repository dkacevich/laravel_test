<?php

use App\Http\Api\Controllers\FallbackController;
use App\Http\Api\Controllers\Position\PositionListController;
use App\Http\Api\Controllers\Token\CreateTokenController;
use App\Http\Api\Controllers\User\RegisterUserController;
use App\Http\Api\Controllers\User\UserInfoController;
use App\Http\Api\Controllers\User\UserListController;
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

Route::get('/', fn() => "Working");


Route::prefix('users')->group(function () {
    Route::get('/', UserListController::class);
    Route::post('/', RegisterUserController::class)->middleware('valid.token');
    Route::get('/{user_id}', UserInfoController::class);
});


Route::get('token', CreateTokenController::class);
Route::get('positions', PositionListController::class);


Route::fallback(FallbackController::class);
