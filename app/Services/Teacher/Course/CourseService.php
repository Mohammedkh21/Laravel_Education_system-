<?php

namespace App\Services\Teacher\Course;

use App\Models\Teacher;

class CourseService
{

    function getAll()
    {
        return auth()->user()->courses;
    }

    function store($data)
    {
        return auth()->user()->courses()->create($data);
    }

    function isRelated($course_id)
    {
        $result = auth()->user()->courses()->where('courses.id',$course_id)->first();
        if (!$result){
            throw new \Exception('this course not related to you',403);
        }
        return $result;
    }

    function update($course , $data ){
        $this->isRelated($course->id);
        return $course->update($data);
    }

    function destroy($course  ){
        $this->isRelated($course->id);
        return $course->delete();
    }
}
