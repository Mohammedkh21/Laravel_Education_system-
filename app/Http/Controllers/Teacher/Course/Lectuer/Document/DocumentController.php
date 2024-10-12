<?php

namespace App\Http\Controllers\Teacher\Course\Lectuer\Document;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Document;
use App\Models\Lecture;
use App\Services\Teacher\Document\DocumentService;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function __construct(public DocumentService $documentService)
    {

    }

    function index(Course $course,Lecture $lecture)
    {
        return response()->json(
            $this->documentService->getAll($course->id,$lecture->id)
        );
    }

    function download(Course $course,Lecture $lecture,Document $document)
    {
        return $this->documentService->download($course->id,$lecture->id,$document->id);
    }

    function destroy(Course $course,Lecture $lecture,Document $document)
    {
        return response()->json(
            $this->documentService->destroy($course->id,$lecture->id,$document->id)
        );
    }
}
