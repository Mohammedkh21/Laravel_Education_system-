<?php

namespace App\Http\Controllers\Admin\Teacher;

use App\Http\Requests\TeacherUpdateRequest;
use App\Models\Camp;
use App\Models\Teacher;
use App\Services\Admin\Teacher\TeacherService;

class TeacherController
{

    public function __construct(public  TeacherService $teacherService)
    {
    }

    function index()
    {
        return response()->json(
            $this->teacherService->getAll()
        );
    }

    function show(Teacher $teacher)
    {
        $teacher =  $this->teacherService->show($teacher->id);
        if (!$teacher){
            return response()->json([
                'message' => 'teacher  is NOT related to the Admin'
            ], 403);
        }
        return response()->json(
            $teacher
        );
    }

    function update(TeacherUpdateRequest $request,Teacher $teacher)
    {
        return response()->json(
            $this->teacherService->update($request->getData() , $teacher)
        );
    }

    function destroy(Teacher $teacher)
    {
        return response()->json(
            $this->teacherService->destroy( $teacher)
        );
    }
}
