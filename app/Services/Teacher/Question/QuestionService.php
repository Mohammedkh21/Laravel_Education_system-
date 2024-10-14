<?php

namespace App\Services\Teacher\Question;

class QuestionService
{

    function getAll($quiz)
    {
        return $quiz->questions;
    }

    function store($quiz,$data)
    {
        return $quiz->questions()->create($data);
    }

    function update($question,$data)
    {
        return $question->update($data);
    }

    function destroy($question)
    {
        return $question->delete();
    }
}
