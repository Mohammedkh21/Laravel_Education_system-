<?php

namespace App\Services\Teacher\Assignment;

use App\Models\Assignment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AssignmentService
{

    function getAll($course)
    {
        return $course->assignments()->with('documents')->get();
    }

    function show($course,$assignment)
    {
        return $course->assignments()->with('documents')->find($assignment->id);
    }

    function store($course,$request)
    {

        $documents = [];
        DB::beginTransaction();
        $assignment = $course->assignments()->create($request->getData());
        try{
            foreach ($request->file('files') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();

                $path = $file->storeAs('uploads', $fileName, 'public');

                $documents[] =  $assignment->documents()->create([
                    'path'=> $path,
                    'type' => $file->getClientMimeType(),
                ]);
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            foreach ($documents as $document) {
                if (Storage::disk('public')->exists($document->path)) {
                    Storage::disk('public')->delete($document->path);
                }
            }
            return  $e;
        }
        return  Assignment::with('documents')->find($assignment->id);
    }

    function update($assignment,$data)
    {
        return $assignment->update($data);
    }

    function destroy($assignment)
    {
        return $assignment->delete();
    }

}
