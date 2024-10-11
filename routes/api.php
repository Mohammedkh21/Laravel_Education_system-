<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('student')->group(function (){
    Route::post('register',[\App\Http\Controllers\Student\AuthController::class,'register']);
    Route::post('login',[\App\Http\Controllers\Student\AuthController::class,'login']);
    Route::middleware('auth:student')->group(function (){
        Route::post('logout',[\App\Http\Controllers\Student\AuthController::class,'logout']);
        Route::get('index',[\App\Http\Controllers\Student\AuthController::class,'index']);
        Route::post('update',[\App\Http\Controllers\Student\AuthController::class,'update']);
        Route::prefix('notifications')->group(function (){
            Route::get('/',[\App\Http\Controllers\Student\Notification\NotificationController::class,'index']);
            Route::get('/mark_as_read',[\App\Http\Controllers\Student\Notification\NotificationController::class,'markAsRead']);
        });
        Route::prefix('camp')->group(function (){
           Route::get('/',[\App\Http\Controllers\Student\Camp\CampController::class,'show']);
           Route::get('/{camp}',[\App\Http\Controllers\Student\Camp\CampController::class,'join']);
           // remove from camp
        });
    });
});

Route::prefix('teacher')->group(function (){
    Route::post('register',[\App\Http\Controllers\Teacher\AuthController::class,'register']);
    Route::post('login',[\App\Http\Controllers\Teacher\AuthController::class,'login']);
    Route::middleware('auth:teacher')->group(function (){
        Route::post('logout',[\App\Http\Controllers\Teacher\AuthController::class,'logout']);
        Route::get('index',[\App\Http\Controllers\Teacher\AuthController::class,'index']);
        Route::post('update',[\App\Http\Controllers\Teacher\AuthController::class,'update']);
        Route::prefix('notifications')->group(function (){
            Route::get('/',[\App\Http\Controllers\Teacher\Notification\NotificationController::class,'index']);
            Route::get('/mark_as_read',[\App\Http\Controllers\Teacher\Notification\NotificationController::class,'markAsRead']);
        });
        Route::prefix('camps')->group(function (){
            Route::get('/',[\App\Http\Controllers\Teacher\Camp\CampController::class,'index']);
            Route::get('/show/{camp}',[\App\Http\Controllers\Teacher\Camp\CampController::class,'show']);
            Route::get('/join/{camp}',[\App\Http\Controllers\Teacher\Camp\CampController::class,'join']);
            Route::delete('/forget/{camp}',[\App\Http\Controllers\Teacher\Camp\CampController::class,'forget']);
        });
    });
});

Route::prefix('admin')->group(function (){
    Route::post('register',[\App\Http\Controllers\Admin\AuthController::class,'register']);
    Route::post('login',[\App\Http\Controllers\Admin\AuthController::class,'login']);
    Route::middleware('auth:admin')->group(function (){
        Route::post('logout',[\App\Http\Controllers\Admin\AuthController::class,'logout']);
        Route::get('index',[\App\Http\Controllers\Admin\AuthController::class,'index']);
        Route::post('update',[\App\Http\Controllers\Admin\AuthController::class,'update']);
        Route::prefix('notifications')->group(function (){
           Route::get('/',[\App\Http\Controllers\Admin\Notification\NotificationController::class,'index']);
           Route::get('/mark_as_read',[\App\Http\Controllers\Admin\Notification\NotificationController::class,'markAsRead']);
        });
        Route::prefix('camps')->group(function (){
            Route::prefix('requests')->group(function (){
                Route::get('/',[\App\Http\Controllers\Admin\Request\RequestController::class,'index']);
                Route::get('/reply/{request}/{status}',[\App\Http\Controllers\Admin\Request\RequestController::class,'reply']);
            });


            Route::prefix('/teachers')->group(function (){
                Route::get('/',[\App\Http\Controllers\Admin\Teacher\TeacherController::class,'index']);
                Route::prefix('/{teacher}')->group(function (){
                    Route::get('/',[\App\Http\Controllers\Admin\Teacher\TeacherController::class,'show']);
                    Route::post('/',[\App\Http\Controllers\Admin\Teacher\TeacherController::class,'update']);
                    Route::delete('/',[\App\Http\Controllers\Admin\Teacher\TeacherController::class,'destroy']);
                });
            });

            Route::prefix('/students')->group(function (){
                Route::get('/',[\App\Http\Controllers\Admin\Student\StudentController::class,'index']);
                Route::prefix('/{student}')->group(function (){
                    Route::get('/',[\App\Http\Controllers\Admin\Student\StudentController::class,'show']);
                    Route::post('/',[\App\Http\Controllers\Admin\Student\StudentController::class,'update']);
                    Route::delete('/',[\App\Http\Controllers\Admin\Student\StudentController::class,'destroy']);
                });
            });


        });
        Route::apiResource('camps',\App\Http\Controllers\admin\Camp\CampController::class);

    });
});

Route::prefix('camp')->group(function (){
    Route::get('getAll',[\App\Http\Controllers\Camp\CampController::class,'getAll']);
});

