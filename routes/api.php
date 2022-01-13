<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SchoolController;
use App\Http\Controllers\Api\UserController;
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
    Route::post('/admin',[AdminController::class,'store']);

    //Protected routes
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::group(['prefix' => 'auth'], function () {
            Route::post('logout', [AuthController::class, 'logout']);
            Route::get('user',[AuthController::class,'user']);
        });

        Route::apiResources([
            'admin' => AdminController::class,
            'user' => UserController::class,
            'school' => SchoolController::class,
        ]);

    });
});


