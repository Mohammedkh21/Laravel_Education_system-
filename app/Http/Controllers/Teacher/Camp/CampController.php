<?php

namespace App\Http\Controllers\Teacher\Camp;

use App\Http\Controllers\Controller;
use App\Models\Camp;
use App\Services\Teacher\Camp\CampService;
use Illuminate\Http\Request;

class CampController extends Controller
{
    public function __construct(public CampService $campService)
    {
    }

    function index()
    {
        return response()->json(
            $this->campService->showAll()
        );
    }

    function show(Camp $camp)
    {
        $camp =  $this->campService->show($camp->id);
        if (!$camp){
            return response()->json([
                'message' => 'Teacher is NOT related to the camp'
            ], 403);
        }

        return response()->json(
            $camp
        );
    }

    function join(Camp $camp)
    {
        $camp =  $this->campService->joinCamp($camp);
        return response()->json(
            ['message'=>'join camp request sent']
        );
    }

    function forget(Camp $camp)
    {
        $result = $this->campService->forget($camp->id);
        if (!$result){
            return response()->json([
                'message' => 'Teacher is NOT related to the camp'
            ], 403);
        }
        return response()->json(
            $result
        );
    }
}
