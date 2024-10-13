<?php

namespace App\Services\Student\Lecture;

use App\Models\Lecture;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LectureService
{

    function getAll($course)
    {
        return $course->lectures()->get();
    }

    function show($course,$lecture)
    {
        return $course->lectures()->with('documents')->find($lecture->id);
    }


}
