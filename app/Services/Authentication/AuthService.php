<?php

namespace App\Services\Authentication;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    function register($class,$data){
        $data['password'] = Hash::make($data['password']);
        return $class::create($data);
    }

    function login($class , $data){
        $user = $class::where('email',$data['email'])->first();
        if (!$user || !Hash::check($data['password'] , $user->password)) {
            throw ValidationException::withMessages([
                'message' => ['Invalid credentials.'],
            ]);
        }
        return $user->createToken('MyApp')->plainTextToken;
    }

    function logout($request){
        return $request->user()->currentAccessToken()->delete();
    }


    function update($user,$data){
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        $user->update($data);
        return $user;
    }
}
