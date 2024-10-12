<?php

namespace App\Services\Teacher\Document;

use Illuminate\Support\Facades\Storage;

class DocumentService
{
    function getAll($course_id,$lecture_id)
    {
        return auth()->user()->courses()->find($course_id)
            ->lectures()->find($lecture_id)->documents;
    }

    function download($course_id,$lecture_id,$document_id)
    {
        $document =  auth()->user()->courses()->find($course_id)
            ->lectures()->find($lecture_id)->documents()->find($document_id);
        if (Storage::disk('public')->exists($document->path)) {
            return Storage::disk('public')->download($document->path);
        }

        return response()->json(['error' => 'File not found'], 404);
    }

    function destroy($course_id,$lecture_id,$document_id)
    {
        return auth()->user()->courses()->find($course_id)
            ->lectures()->find($lecture_id)->documents()->find($document_id)->delete();
    }

}
