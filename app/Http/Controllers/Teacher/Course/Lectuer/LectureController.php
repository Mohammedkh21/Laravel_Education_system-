<?php

namespace App\Http\Controllers\Teacher\Course\Lectuer;

use App\Http\Controllers\Controller;
use App\Http\Requests\LectureStoreRequest;
use App\Http\Requests\LectureUpdateRequest;
use App\Models\Course;
use App\Models\Lecture;
use App\Services\Teacher\Lecture\LectureService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class LectureController extends Controller implements HasMiddleware
{
    public function __construct(public LectureService $lectureService)
    {
    }

    public static function middleware(): array
    {
        return [
            'can:access,course',
            new Middleware('can:access,lecture',except:['index','store'])

        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Course $course)
    {
        return response()->json(
            $this->lectureService->getAll($course)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LectureStoreRequest $request,Course $course)
    {
        return response()->json(
            $this->lectureService->store($course,$request)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course,Lecture $lecture)
    {
        return response()->json(
            $this->lectureService->show($course,$lecture)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LectureUpdateRequest $request, Course $course,Lecture $lecture)
    {
        return response()->json(
            $this->lectureService->update($lecture,$request->getData())
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course,Lecture $lecture)
    {
        return response()->json(
            $this->lectureService->destroy($lecture)
        );
    }
}
