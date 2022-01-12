<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

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
Route::get('route/list', function () {
    return $routes = collect(Route::getRoutes())->map(function ($route) {
        return $route;
    });
});

Route::group(['prefix' => 'v1'], function () {

    //Public routes
    Route::post('auth/login', [AuthController::class, 'login']);

    //Protected routes
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::group(['prefix' => 'auth'], function () {
            Route::post('logout', [AuthController::class, 'logout']);
            //Route::get('user',[UserController::class]);
        });

        Route::apiResources([
            'admin' => AdminController::class,
        ]);

    });
});


