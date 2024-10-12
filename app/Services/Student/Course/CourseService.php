<?php

namespace App\Services\Student\Course;

use App\Models\Course;

class CourseService
{

    function getAll()
    {
        return auth()->user()->courses;
    }

    function join($course_id)
    {
        return auth()->user()->courses()->syncWithoutDetaching([$course_id]);
    }

    function leave($course_id)
    {
        return auth()->user()->courses()->detach([$course_id]);
    }

    function available()
    {
        return Course::whereDoesntHave('students', function ($query) {
            $query->where('student_id', auth()->user()->id);
        })->get();
    }
}
