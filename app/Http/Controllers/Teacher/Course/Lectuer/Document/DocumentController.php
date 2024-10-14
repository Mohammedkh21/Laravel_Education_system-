<?php

namespace App\Http\Controllers\Teacher\Course\Lectuer\Document;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentStoreRequest;
use App\Models\Course;
use App\Models\Document;
use App\Models\Lecture;
use App\Services\Teacher\Document\DocumentService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class DocumentController extends Controller implements HasMiddleware
{
    public function __construct(public DocumentService $documentService)
    {

    }

    public static function middleware(): array
    {
        return [
            'can:access,course',
            'can:access,lecture',
            new Middleware('can:access,document',only:['show','destroy'])

        ];
    }

    function index(Course $course,Lecture $lecture)
    {
        return response()->json(
            $this->documentService->getAll($lecture)
        );
    }

    public function store(DocumentStoreRequest $request , Course $course,Lecture $lecture )
    {
        return response()->json(
            $this->documentService->store($lecture,$request)
        );
    }
    function show(Course $course,Lecture $lecture,Document $document)
    {
        return $this->documentService->download($document);
    }

    function destroy(Course $course,Lecture $lecture,Document $document)
    {
        return response()->json(
            $this->documentService->destroy( $document)
        );
    }
}
