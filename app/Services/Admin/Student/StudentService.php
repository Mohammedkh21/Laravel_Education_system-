<?php

namespace App\Services\Admin\Student;

use App\Models\Admin;

class StudentService
{

    public function __construct(public Admin $admin)
    {
        $this->admin = auth()->user();
    }
    function getAll()
    {
        return $this->admin->camps()->with('students')->get()
            ->pluck('students')
            ->flatten()
            ;
    }

    function show($student_id)
    {
        return $this->admin->camps()->with(['students'=>function($query) use($student_id){
            $query->where('students.id',$student_id);
        }])->get()
            ->pluck('students')
            ->flatten()
            ->first()
            ;
    }

    function update($data,$student)
    {
        $isRelated = $this->show($student->id);
        if($isRelated){
            return $student->update($data);
        }
        return false;
    }

    function destroy($student){
        $isRelated = $this->show($student->id);
        if($isRelated){
            return $student->delete();
        }
        return false;
    }

}
