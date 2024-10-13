<?php

namespace App\Http\Controllers\Teacher\Course\Assignment\Document;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentStoreRequest;
use App\Models\Assignment;
use App\Models\Course;
use App\Models\Document;
use App\Services\Teacher\Document\DocumentService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class DocumentController extends Controller implements  HasMiddleware
{
    public function __construct(public DocumentService $documentService)
    {

    }

    public static function middleware(): array
    {
        return [
            'can:access,course',
            'can:access,assignment',
            new Middleware('can:access,document',only:['show','destroy'])

        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course,Assignment $assignment)
    {
        return response()->json(
            $this->documentService->getAll($assignment)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DocumentStoreRequest $request , Course $course,Assignment $assignment)
    {info('controller');
        return response()->json(
            $this->documentService->store($assignment,$request)
        );
    }

    /**
     * Display the specified resource.
     */
    function show(Course $course,Assignment $assignment,Document $document)
    {
        return $this->documentService->download($document);
    }


    /**
     * Remove the specified resource from storage.
     */
    function destroy(Course $course,Assignment $assignment,Document $document)
    {
        return response()->json(
            $this->documentService->destroy( $document)
        );
    }
}
