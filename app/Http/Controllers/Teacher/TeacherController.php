<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentUpdateRequest;
use App\Services\Teacher\TeacherService;

class TeacherController extends Controller
{
    public function __construct(public TeacherService $teacherService)
    {
    }



}
