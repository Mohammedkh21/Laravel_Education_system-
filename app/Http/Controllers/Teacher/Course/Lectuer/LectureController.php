<?php

namespace App\Http\Controllers\Teacher\Course\Lectuer;

use App\Http\Controllers\Controller;
use App\Http\Requests\LectureStoreRequest;
use App\Http\Requests\LectureUpdateRequest;
use App\Models\Course;
use App\Models\Lecture;
use App\Services\Teacher\Lecture\LectureService;
use Illuminate\Http\Request;

class LectureController extends Controller
{
    public function __construct(public LectureService $lectureService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Course $course)
    {
        return response()->json(
            $this->lectureService->getAll($course->id)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LectureStoreRequest $request,Course $course)
    {
        return response()->json(
            $this->lectureService->store($course->id,$request)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course,Lecture $lecture)
    {
        $this->lectureService->show($course->id,$lecture->id);
        return response()->json(
            $lecture
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LectureUpdateRequest $request, Course $course,Lecture $lecture)
    {
        return response()->json(
            $this->lectureService->update($course->id,$lecture->id,$request->getData())
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course,Lecture $lecture)
    {
        return response()->json(
            $this->lectureService->destroy($course->id,$lecture->id)
        );
    }
}
