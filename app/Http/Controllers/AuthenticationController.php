<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    /**
     * Login authentication for the user
     */
    public function login(Request $req){
        try{
            $req->validate([
                'email' => 'required|email',
                'password' => 'required|string',
                'device_name' => 'required|string'
            ]);

            $user = User::where('email', $req->email)->first();

            if (!$user || !Hash::check($req->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            $token = $user->createToken($req->device_name)->plainTextToken;

            return Response::success([
                'action' => 'Authentication Successful',
                'message'=> 'You are successfully authenticated',
                'data' => [
                    'api_token' => $token
                ]
            ]);

        }catch(ValidationException $e){
            Response::fail([
                'message' => "Validation failed",
                'error' => $e->errors()
            ]);
        }
    }
}
