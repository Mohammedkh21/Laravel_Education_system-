<?php

namespace App\Http\Controllers\Teacher\Course\Assignment;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssignmentStoreRequest;
use App\Http\Requests\AssignmentUpdateRequest;
use App\Models\Assignment;
use App\Models\Course;
use App\Models\Student;
use App\Services\Teacher\Assignment\AssignmentService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AssignmentController extends Controller implements HasMiddleware
{
    public function __construct(public AssignmentService $assignmentService)
    {
    }

    public static function middleware(): array
    {
        return [
            'can:access,course',
            new Middleware('can:access,assignment',except:['index','store'])

        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Course $course)
    {
        return response()->json(
            $this->assignmentService->getAll($course)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AssignmentStoreRequest $request,Course $course)
    {
        return response()->json(
            $this->assignmentService->store($course,$request)
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course,Assignment $assignment)
    {
        return response()->json(
            $this->assignmentService->show($course,$assignment)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AssignmentUpdateRequest $request, Course $course,Assignment $assignment)
    {
        return response()->json(
            $this->assignmentService->update($assignment,$request->getData())
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course,Assignment $assignment)
    {
        return response()->json(
            $this->assignmentService->destroy($assignment)
        );
    }

    function studentSubmits(Course $course,Assignment $assignment)
    {
        return response()->json(
            $this->assignmentService->studentSubmits($course,$assignment)
        );
    }

    function downloadStudentSubmit(Course $course,Assignment $assignment,Student $student)
    {
        return $this->assignmentService->downloadStudentSubmit($course,$assignment,$student);
    }

    function rate(Course $course,Assignment $assignment,Student $student)
    {
        return $this->assignmentService->rate($course,$assignment,$student);
    }
}
