<?php

namespace App\Services\Teacher\Quiz;

use App\Models\Quiz;

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

    function show($course,$quiz)
    {
        return Quiz::with('quizAttempts.student','quizAttempts.grade')->find($quiz->id);
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
