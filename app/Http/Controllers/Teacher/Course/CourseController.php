<?php

namespace App\Http\Controllers\Teacher\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseStoreRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Models\Course;
use App\Services\Teacher\Course\CourseService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __construct(public CourseService $courseService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            $this->courseService->getAll()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseStoreRequest $request)
    {
        return response()->json(
            $this->courseService->store($request->getData())
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $this->courseService->isRelated($course->id);
        return response()->json($course);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseUpdateRequest $request, Course $course)
    {
        return response()->json(
            $this->courseService->update($course,$request->getData())
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        return response()->json(
            $this->courseService->destroy($course)
        );
    }
}
