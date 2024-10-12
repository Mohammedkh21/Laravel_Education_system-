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
        return  $this->admin->students();
    }

    function update($data,$student)
    {
        return $student->update($data);
    }

    function destroy($student){
        return $student->delete();
    }

}
