<?php

namespace App\Http\Controllers\Admin\Request;

use App\Http\Controllers\Controller;
use App\Services\Admin\Request\RequestService;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function __construct(public RequestService $requestService)
    {
    }

    function index()
    {
        return response()->json(
          $this->requestService->getAll()
        );
    }

    function reply(\App\Models\Request $request , $status)
    {
        return response()->json(
            $this->requestService->reply($request , $status)
        );
    }
}
