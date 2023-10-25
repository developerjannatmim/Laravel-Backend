<?php

use App\Http\Controllers\AdminController;
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

Route::controller(AdminController::class)->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('', 'admin_list');
        Route::post('', 'admin_store');
        Route::group(['prefix' => '{admin}'], function () {
            Route::get('', 'admin_show');
            Route::put('', 'admin_update');
            Route::delete('', 'admin_destroy');
        });
    });

    Route::group(['prefix' => 'classes'], function () {
        Route::get('', 'class_list');
        Route::post('', 'class_store');
        Route::group(['prefix' => '{class}'], function () {
            Route::get('', 'class_show');
            Route::put('', 'class_update');
            Route::delete('', 'class_destroy');
        });
    });

    Route::group(['prefix' => 'subjects'], function () {
        Route::get('', 'subject_list');
        Route::post('', 'subject_store');
        Route::group(['prefix' => '{subject}'], function () {
            Route::get('', 'subject_show');
            Route::put('', 'subject_update');
            Route::delete('', 'subject_destroy');
        });
    });
});

