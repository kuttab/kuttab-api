<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AssistantController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DailyRecordController;
use App\Http\Controllers\Api\ParentChildController;
use App\Http\Controllers\Api\QuraanController;
use App\Http\Controllers\Api\SchoolController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\SunnaController;
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

    /** Public routes **/
    Route::post('auth/login', [AuthController::class, 'login']);
    Route::post('/admin', [AdminController::class, 'store']);

    /** Protected routes **/
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::group(['prefix' => 'auth'], function () {
            Route::post('logout', [AuthController::class, 'logout']);
            Route::get('user', [AuthController::class, 'user']);
        });

        if (\App\Models\Admin::all()->count() > 0) {
            Route::apiResources([
                'admin' => AdminController::class,
            ]);
        }

        //Parent Routes
        Route::get('parent/{id}/children',[ParentChildController::class,'getChildren']);
        Route::get('parent/{id}/children/lastRecord',[ParentChildController::class,'lastRecordForEachChild']);

        //Student Routes
        Route::get('student/{id}/lastRecord/byLimit',[StudentController::class,'getLastRecordsByLimit']);
        Route::get('student/{id}/lastRecord/byDate',[StudentController::class,'getLastRecordsByDate']);

        //Api Resources Routes
        Route::apiResources([
            'user' => UserController::class,
            'school' => SchoolController::class,
            'assistant' => AssistantController::class,
            'attendance' => AttendanceController::class,
            'dailyRecord' => DailyRecordController::class,
            'quraan' => QuraanController::class,
            'sunna' => SunnaController::class,
            'parentChild' => ParentChildController::class,
        ]);

    });
});


