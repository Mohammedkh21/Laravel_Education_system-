<?php

namespace App\Services\Teacher\Quiz;

class QuizService
{

    function getAll($course)
    {
        return $course->quizzes;
    }

    function store($data,$course)
    {
        return $course->quizzes()->create($data);
    }


    function update($data,$quiz)
    {
        return $quiz->update($data);
    }

    function destroy($quiz)
    {
        return $quiz->delete();
    }

}
