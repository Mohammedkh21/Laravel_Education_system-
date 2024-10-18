<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('student')->group(function (){
    Route::post('register',[\App\Http\Controllers\Student\AuthController::class,'register']);
    Route::post('login',[\App\Http\Controllers\Student\AuthController::class,'login']);
    Route::prefix('resit_password')->group(function (){
        Route::post('/otp',[\App\Http\Controllers\Student\AuthController::class,'sendResitPasswordOTP']);
        Route::post('/check_otp',[\App\Http\Controllers\Student\AuthController::class,'checkOTP']);
        Route::post('/',[\App\Http\Controllers\Student\AuthController::class,'resitPassword']);

    });
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
        Route::prefix('courses')->group(function (){
            Route::get('/timeline',[\App\Http\Controllers\Student\Course\CourseController::class,'timeline']);
            Route::get('/',[\App\Http\Controllers\Student\Course\CourseController::class,'index']);
            Route::get('/join/{course}',[\App\Http\Controllers\Student\Course\CourseController::class,'join']);
            Route::get('/leave/{course}',[\App\Http\Controllers\Student\Course\CourseController::class,'leave']);
            Route::get('/available',[\App\Http\Controllers\Student\Course\CourseController::class,'available']);
            Route::prefix('{course}')
                ->middleware('can:access,course')
                ->group(function (){
                    Route::prefix('/lectures')->group(function (){
                        Route::get('/',[\App\Http\Controllers\Student\Course\Lecture\LectureController::class,'index']);
                        Route::get('/{lecture}',[\App\Http\Controllers\Student\Course\Lecture\LectureController::class,'show']);
                        Route::get('/documents/{document}',\App\Http\Controllers\Student\Course\Lecture\Document\DocumentController::class);

                    });
                    Route::prefix('/assignments')->group(function (){
                        Route::get('/',[\App\Http\Controllers\Student\Course\Assignment\AssignmentController::class,'index']);
                        Route::get('/{assignment}',[\App\Http\Controllers\Student\Course\Assignment\AssignmentController::class,'show']);
                        Route::get('/documents/{document}',\App\Http\Controllers\Student\Course\Assignment\Document\DocumentController::class);
                        Route::post('/{assignment}/submit',[\App\Http\Controllers\Student\Course\Assignment\AssignmentController::class,'submit']);
                        Route::get('/{assignment}/submit',[\App\Http\Controllers\Student\Course\Assignment\AssignmentController::class,'showSubmit']);
                        Route::delete('/{assignment}/submit',[\App\Http\Controllers\Student\Course\Assignment\AssignmentController::class,'deleteSubmit']);
                    });
                    Route::prefix('quizzes')->group(function (){
                        Route::get('/',[\App\Http\Controllers\Student\Course\Quiz\QuizController::class,'index']);
                        Route::get('/{quiz}',[\App\Http\Controllers\Student\Course\Quiz\QuizController::class,'show']);
                        Route::get('/{quiz}/attempt',[\App\Http\Controllers\Student\Course\Quiz\QuizController::class,'attempt']);
                        Route::post('/{quiz}/attempt',[\App\Http\Controllers\Student\Course\Quiz\QuizController::class,'submitAttempt']);
                    });


                });
        });
    });
});

Route::prefix('teacher')->group(function (){
    Route::post('register',[\App\Http\Controllers\Teacher\AuthController::class,'register']);
    Route::post('login',[\App\Http\Controllers\Teacher\AuthController::class,'login']);
    Route::prefix('resit_password')->group(function (){
        Route::post('/otp',[\App\Http\Controllers\Teacher\AuthController::class,'sendResitPasswordOTP']);
        Route::post('/check_otp',[\App\Http\Controllers\Teacher\AuthController::class,'checkOTP']);
        Route::post('/',[\App\Http\Controllers\Teacher\AuthController::class,'resitPassword']);

    });
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
        Route::prefix('/courses/{course}/assignments/{assignment}/submits')->group(function (){
            Route::get('/',[\App\Http\Controllers\Teacher\Course\Assignment\AssignmentController::class,'studentSubmits']);
            Route::get('/students/{student}',[\App\Http\Controllers\Teacher\Course\Assignment\AssignmentController::class,'downloadStudentSubmit']);
            Route::post('/students/{student}',[\App\Http\Controllers\Teacher\Course\Assignment\AssignmentController::class,'rate']);
        });
        Route::apiResource('courses.quizzes.questions',\App\Http\Controllers\Teacher\Course\Quiz\Question\QuestionController::class);
        Route::apiResource('courses.quizzes',\App\Http\Controllers\Teacher\Course\Quiz\QuizController::class);
        Route::apiResource('courses.assignments.documents', \App\Http\Controllers\Teacher\Course\Assignment\Document\DocumentController::class)
            ->except(['update']);
        Route::apiResource('courses.assignments',\App\Http\Controllers\Teacher\Course\Assignment\AssignmentController::class);
        Route::apiResource('courses.lectures.documents', \App\Http\Controllers\Teacher\Course\Lectuer\Document\DocumentController::class)
            ->except(['update']);
        Route::apiResource('courses.lectures',\App\Http\Controllers\Teacher\Course\Lectuer\LectureController::class);
        Route::apiResource('courses',\App\Http\Controllers\Teacher\Course\CourseController::class);
    });
});

Route::prefix('admin')->group(function (){
    Route::post('register',[\App\Http\Controllers\Admin\AuthController::class,'register']);
    Route::post('login',[\App\Http\Controllers\Admin\AuthController::class,'login']);
    Route::prefix('resit_password')->group(function (){
        Route::post('/otp',[\App\Http\Controllers\Admin\AuthController::class,'sendResitPasswordOTP']);
        Route::post('/check_otp',[\App\Http\Controllers\Admin\AuthController::class,'checkOTP']);
        Route::post('/',[\App\Http\Controllers\Admin\AuthController::class,'resitPassword']);

    });
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

            Route::get('/teachers/courses',[\App\Http\Controllers\Admin\Course\CourseController::class,'teachersWithCourses']);
            Route::apiResource('teachers',\App\Http\Controllers\Admin\Teacher\TeacherController::class)
                ->except(['store']);
            Route::apiResource('students',\App\Http\Controllers\Admin\Student\StudentController::class)
                ->except(['store']);
        });
        Route::apiResource('camps',\App\Http\Controllers\admin\Camp\CampController::class);

    });
});

Route::prefix('camp')->group(function (){
    Route::get('getAll',[\App\Http\Controllers\Camp\CampController::class,'getAll']);
});

