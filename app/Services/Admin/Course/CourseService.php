<?php

namespace App\Services\Admin\Course;

use App\Models\Course;

class CourseService
{

    function getAll()
    {
        return auth()->user()->camps()->with('teachers.courses')->get()
            ->pluck('teachers')
            ->flatten()
            ->unique('id');
    }
}
