<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentUpdateRequest;
use App\Services\Student\StudentService;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct(public StudentService $studentService)
    {
    }



}
