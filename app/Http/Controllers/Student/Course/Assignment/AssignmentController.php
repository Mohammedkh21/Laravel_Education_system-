<?php

namespace App\Http\Controllers\Student\Course\Assignment;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Course;
use App\Models\Lecture;
use App\Services\Student\Assignment\AssignmentService;
use App\Services\Student\Lecture\LectureService;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function __construct(public AssignmentService $assignmentService)
    {
    }

    function index(Course $course)
    {
        return response()->json(
            $this->assignmentService->getAll($course)
        );
    }

    function show(Course $course,Assignment $assignment)
    {
        return response()->json(
            $this->assignmentService->show($course,$assignment)
        );
    }
    function showSubmit(Course $course,Assignment $assignment){
        return response()->json(
            $this->assignmentService->showSubmit($course,$assignment)
        );
    }

    function deleteSubmit(Course $course,Assignment $assignment)
    {
        return response()->json(
            $this->assignmentService->deleteSubmit($course,$assignment)
        );
    }

    function submit(Request $request,Course $course,Assignment $assignment)
    {
        $request->validate([
            'files.*' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,zip|max:2048',
        ]);
        return response()->json(
            $this->assignmentService->submit($request,$course,$assignment)
        );

    }

}
