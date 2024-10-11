<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StudentRegisterRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Models\Student;
use App\Services\Student\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(public AuthService $authService)
    {
    }

    public function register(StudentRegisterRequest $request){
        $student = $this->authService->register(
            Student::class,
            $request->getData()
        );
        return response()->json($student);
    }

    public function login(LoginRequest $request){
        $token = $this->authService->login(
            Student::class ,
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

    function update(StudentUpdateRequest $request){
        return response()->json(
            $this->authService->update(
                auth()->user() , $request->getData()
            )
        );
    }

}
