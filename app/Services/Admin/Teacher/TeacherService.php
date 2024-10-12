<?php

namespace App\Services\Admin\Teacher;

use App\Models\Admin;
use App\Models\Teacher;

class TeacherService
{

    public function __construct(public Admin $admin)
    {
        $this->admin = auth()->user();
    }
    function getAll()
    {
        return $this->admin->teachers();
    }


    function update($data,$teacher)
    {
        return $teacher->update($data);
    }

    function destroy($teacher){
        return $teacher->delete();
    }

}
