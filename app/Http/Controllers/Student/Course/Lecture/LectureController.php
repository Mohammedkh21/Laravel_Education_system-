<?php

namespace App\Http\Controllers\Student\Course\Lecture;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lecture;
use App\Services\Student\Lecture\LectureService;
use Illuminate\Http\Request;

class LectureController extends Controller
{
    public function __construct(public LectureService $lectureService)
    {
    }

    function index(Course $course)
    {
        return response()->json(
            $this->lectureService->getAll($course)
        );
    }

    function show(Course $course,Lecture $lecture)
    {
        $result = $this->lectureService->show($course,$lecture);
        if ($result){
            return response()->json(
                $result
            );
        }
        return response()->json(
            [
                'message' => 'you dont have access on this lecture',
            ]
        );
    }

}
