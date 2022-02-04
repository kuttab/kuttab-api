<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AssistantController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\AttendanceReasonsController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\ClassCategoryController;
use App\Http\Controllers\Api\ClassesController;
use App\Http\Controllers\Api\DailyRecordController;
use App\Http\Controllers\Api\DatabaseController;
use App\Http\Controllers\Api\ParentChildController;
use App\Http\Controllers\Api\QuraanAchievementTypeController;
use App\Http\Controllers\Api\QuraanController;
use App\Http\Controllers\Api\SchoolController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\SunnaController;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\Api\TeacherStudentController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Notification;
use App\Notifications\SendPushNotification;
use Kutia\Larafirebase\Facades\Larafirebase;
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

    //Auth Routes
    Route::post('auth/user/login', [AuthController::class, 'userLogin']);
    Route::post('auth/admin/login', [AuthController::class, 'adminLogin']);
    Route::post('/auth/verify', [AuthController::class, 'verify']);

    //Resource Routes
    Route::apiResource('school',SchoolController::class)->only('store');


    /** Protected routes **/
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::group(['prefix' => 'auth'], function () {
            Route::post('logout', [AuthController::class, 'logout']);
            Route::get('user', [AuthController::class, 'user']);
            Route::put('password', [AuthController::class, 'changePassword']);
        });

        //Users Routes

        //Parent Routes
        Route::get('parent/{id}/children',[ParentChildController::class,'getChildren']);
        Route::get('parent/{id}/children/lastRecord',[ParentChildController::class,'lastRecordForEachChild']);
        Route::get('available/parent',[ParentChildController::class,'getAvailableParent']);
        Route::get('available/children',[ParentChildController::class,'getAvailableChildren']);

        //Student Routes
        Route::get('student/{id}/lastRecord/byLimit',[StudentController::class,'getLastRecordsByLimit']);
        Route::get('student/{id}/lastRecord/byDate',[StudentController::class,'getLastRecordsByDate']);
        Route::get('student/{id}/classInfo',[StudentController::class,'getStudentWithClassInfo']);
        Route::get('student/search/byUsername',[StudentController::class,'searchByUsername']);
        Route::get('available/students',[StudentController::class,'getAvailable']);

        //Teacher Routes
        Route::get('teacher/class',[TeacherController::class,'getTeacherHaveClass']);
        Route::get('teacher/{id}/students',[TeacherController::class,'getStudents']);
        Route::get('available/teachers',[TeacherController::class,'getAvailable']);

        //Assistant Routes
        Route::get('available/assistants',[AssistantController::class,'getAvailable']);

        //Api Resources Routes
        Route::apiResource('school',SchoolController::class)->except('store');
        Route::apiResources([
            'user' => UserController::class,
            'admin' => AdminController::class,
            'assistant' => AssistantController::class,
            'attendance' => AttendanceController::class,
            'dailyRecord' => DailyRecordController::class,
            'quraan' => QuraanController::class,
            'sunna' => SunnaController::class,
            'parentChild' => ParentChildController::class,
            'class' => ClassesController::class,
            'category' => CategoriesController::class,
            'classCategory' => ClassCategoryController::class,
            'teacherStudent' => TeacherStudentController::class,
            'attendanceReasons' => AttendanceReasonsController::class,
            'quraanAchievementType' => QuraanAchievementTypeController::class,
        ]);

    });
});

Route::get('/fcm',[\App\Http\Controllers\Controller::class,'index']);
//Route::get('db/export', [DatabaseController::class, 'export']);
//Route::post('db/import', [DatabaseController::class, 'import']);
