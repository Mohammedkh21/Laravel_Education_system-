<?php

namespace App\Http\Controllers\Admin\Student;

use App\Http\Requests\StudentUpdateRequest;
use App\Models\Student;
use App\Services\Admin\Student\StudentService;

class StudentController
{
    public function __construct(public  StudentService $studentService)
    {
    }

    function index()
    {
        return response()->json(
            $this->studentService->getAll()
        );
    }

    function show(Student $student)
    {
        $student =  $this->studentService->show($student->id);
        if (!$student){
            return response()->json([
                'message' => 'student  is NOT related to the Admin'
            ], 403);
        }
        return response()->json(
            $student
        );
    }

    function update(StudentUpdateRequest $request,Student $student)
    {
        return response()->json(
            $this->studentService->update($request->getData() , $student)
        );
    }

    function destroy(Student $student)
    {
        return response()->json(
            $this->studentService->destroy( $student)
        );
    }
}
