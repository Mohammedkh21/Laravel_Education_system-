<?php

namespace App\Http\Controllers\Teacher\Course\Quiz;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuizStoreRequest;
use App\Http\Requests\QuizUpdateRequest;
use App\Models\Course;
use App\Models\Quiz;
use App\Services\Teacher\Quiz\QuizService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class QuizController extends Controller implements HasMiddleware
{
    public function __construct(public QuizService $quizService)
    {
    }

    public static function middleware(): array
    {
        return [
            'can:access,course',
            new Middleware('can:access,quiz',except:['index','store'])

        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course)
    {
        return response()->json(
            $this->quizService->getAll($course)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuizStoreRequest $request,Course $course)
    {
        return response()->json(
            $this->quizService->store($request->getData(),$course)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course,Quiz $quiz)
    {
        return response()->json(
            $quiz
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuizUpdateRequest $request, Course $course,Quiz $quiz)
    {
        return response()->json(
            $this->quizService->update($request->getData(),$quiz)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course,Quiz $quiz)
    {
        return response()->json(
            $this->quizService->destroy($quiz)
        );
    }
}
