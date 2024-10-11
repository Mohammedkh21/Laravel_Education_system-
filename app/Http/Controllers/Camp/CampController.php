<?php

namespace App\Http\Controllers\Camp;

use App\Http\Controllers\Controller;
use App\Services\Camp\CampService;
use Illuminate\Http\Request;

class CampController extends Controller
{
    //
    public function __construct(public CampService $campService)
    {
    }

    function getAll()
    {
        return response()->json(
            $this->campService->getAllCampInfo()
        );
    }
}
