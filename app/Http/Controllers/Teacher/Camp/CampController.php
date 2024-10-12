<?php

namespace App\Http\Controllers\Teacher\Camp;

use App\Http\Controllers\Controller;
use App\Models\Camp;
use App\Services\Teacher\Camp\CampService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CampController extends Controller implements  HasMiddleware
{
    public function __construct(public CampService $campService)
    {
    }

    public static function middleware(): array
    {
        return [
            new Middleware('can:access,camp', only:['forget','show']),
        ];
    }
    function index()
    {
        return response()->json(
            $this->campService->showAll()
        );
    }

    function show(Camp $camp)
    {
        return response()->json(
            $camp
        );
    }

    function join(Camp $camp)
    {
        if (!auth()->user()->can('access', $camp)) {
            $this->campService->joinCamp($camp);
            return response()->json(
                ['message'=>'join camp request sent']
            );
        }
        return response()->json(
            ['message'=>'you are already in this camp'],401
        );
    }

    function forget(Camp $camp)
    {
        return response()->json(
            $this->campService->forget($camp->id)
        );
    }
}
