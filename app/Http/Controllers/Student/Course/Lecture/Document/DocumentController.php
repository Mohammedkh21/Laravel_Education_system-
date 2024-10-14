<?php

namespace App\Http\Controllers\Student\Course\Lecture\Document;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Document;
use App\Models\Lecture;
use App\Services\Student\Document\DocumentService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class DocumentController extends Controller implements HasMiddleware
{
    public function __construct(public  DocumentService $documentService)
    {
    }

    public static function middleware(): array
    {
        return [
            'can:access,course',
            'can:access,document'

        ];
    }
    public function __invoke(Course $course,Lecture$lecture,Document $document)
    {
        return $this->documentService->download($document);
    }
}
