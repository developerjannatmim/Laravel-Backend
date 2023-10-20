<?php

use App\Http\Controllers\UsersController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(UsersController::class)->group(function () {
    Route::group(['prefix' => 'users'], function () {
        Route::get('', 'user_list');
        Route::post('', 'user_store');
        Route::group(['prefix' => '{user}'], function () {
            Route::get('', 'user_show');
            Route::put('', 'user_update');
            Route::delete('', 'user_destroy');
        });
    });
});

