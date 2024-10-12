<?php

namespace App\Services\Teacher\Lecture;

use App\Models\Teacher;
use Illuminate\Support\Facades\Storage;

class LectureService
{
    public function __construct(public Teacher $teacher)
    {
        $this->teacher = auth()->user();
    }

    function getAll($course_id)
    {
        return $this->teacher->courses()->find($course_id)->lectures()->with('documents')->get();
    }

    function store($course_id,$request)
    {
        $lecture = $this->teacher->courses()->find($course_id)->lectures()->create($request->getData());
        if ($request->file('files')){
            foreach ($request->file('files') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();

                $path = $file->storeAs('uploads', $fileName, 'public');

                $lecture->documents()->create([
                    'path'=> $path,
                    'type' => $file->getClientMimeType(),
                ]);
            }
        }
        return $lecture;
    }


    function isRelated($course_id,$lecture_id)
    {
        return $this->teacher->courses()->find($course_id)->lectures()->find($lecture_id);
    }
    function show($course_id,$lecture_id)
    {
        $result = $this->isRelated($course_id,$lecture_id);
        if (!$result){
            throw new \Exception('this lecture not related to you',403);
        }
        return true;
    }

    function update($course_id,$lecture_id,$data)
    {
        return $this->teacher->courses()->find($course_id)->lectures()->find($lecture_id)->update($data);
    }

    function destroy($course_id,$lecture_id)
    {
        $result = $this->isRelated($course_id,$lecture_id);
        return $this->teacher->courses()->find($course_id)->lectures()->find($lecture_id)->delete();
    }

}
