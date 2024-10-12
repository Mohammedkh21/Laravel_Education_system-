<?php

namespace App\Http\Controllers\Student\Course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Services\Student\Course\CourseService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __construct(public CourseService $courseService)
    {
    }

    function index()
    {
        return response()->json(
            $this->courseService->getAll()
        );
    }

    function join(Course $course)
    {
        return response()->json(
            $this->courseService->join($course->id)
        );
    }

    function leave(Course $course)
    {
        return response()->json(
            $this->courseService->leave($course->id)
        );
    }

    function available()
    {
        return response()->json(
            $this->courseService->available()
        );
    }
}
