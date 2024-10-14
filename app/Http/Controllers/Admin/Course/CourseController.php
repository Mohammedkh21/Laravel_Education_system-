<?php

namespace App\Http\Controllers\Admin\Course;

use App\Http\Controllers\Controller;
use App\Services\Admin\Course\CourseService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __construct(public CourseService $courseService)
    {
    }

    function teachersWithCourses()
    {
        return response()->json(
            $this->courseService->getAll()
        );
    }
}
