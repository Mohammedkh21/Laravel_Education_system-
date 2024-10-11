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
        return $this->admin->camps()->with('teachers')->get()
            ->pluck('teachers')
            ->flatten()
            ->unique('id');
    }

    function show($teacher_id)
    {
        return $this->admin->camps()->with(['teachers'=>function($query) use($teacher_id){
            $query->where('teachers.id',$teacher_id);
        }])->get()
            ->pluck('teachers')
            ->flatten()
            ->unique('id')
            ->first()
            ;
    }

    function update($data,$teacher)
    {
        $isRelated = $this->show($teacher->id);
        if($isRelated){
            return $teacher->update($data);
        }
        return false;
    }

    function destroy($teacher){
        $isRelated = $this->show($teacher->id);
        if($isRelated){
            return $teacher->delete();
        }
        return false;
    }

}
