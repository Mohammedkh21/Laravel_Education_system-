<?php

namespace App\Http\Controllers\admin\Camp;

use App\Http\Controllers\Controller;
use App\Http\Requests\CampStoreRequest;
use App\Http\Requests\CampUpdateRequest;
use App\Models\Camp;
use App\Services\Admin\Camp\CampService;
use Illuminate\Http\Request;

class CampController extends Controller
{

    public function __construct(public CampService $campService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            $this->campService->index()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CampStoreRequest $request)
    {
        return response()->json(
            $this->campService->store($request->getData())
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Camp $camp)
    {
        $camp =  $this->campService->show($camp->id);
        if (!$camp){
            return response()->json([
                'message' => 'Admin is NOT related to the camp'
            ], 403);
        }

        return response()->json(
            $camp
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CampUpdateRequest $request, Camp $camp)
    {
        return response()->json(
            $this->campService->update($camp->id,$request->getData())
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Camp $camp)
    {
        return response()->json(
            $this->campService->destroy($camp->id)
        );
    }
}
