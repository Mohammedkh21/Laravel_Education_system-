<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRegisterRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use App\Services\Admin\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(public AuthService $authService)
    {
    }

    public function register(AdminRegisterRequest $request){ info(1);
        $admin = $this->authService->register(
            Admin::class,
            $request->getData()
        );
        return response()->json($admin);
    }

    public function login(LoginRequest $request){
        $token = $this->authService->login(
            Admin::class ,
            $request->getData()
        );
        return response()->json(['token' => $token]);
    }

    public function logout(Request $request){
        $this->authService->logout($request);
        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    function index(){
        return response()->json(
            auth()->user()
        );
    }

    function update(AdminUpdateRequest $request){
        return response()->json(
            $this->authService->update(
                auth()->user() , $request->getData()
            )
        );
    }

}
