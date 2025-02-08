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
            ]);

            $user = User::where('email', $req->email)->first();

            if (!$user || !Hash::check($req->password, $user->password)) {
                return Response::fail([
                    'action' => 'Authentication Failure',
                    'message' => "The provided credentials are incorrect",
                ]);
            }

            $token = $user->createToken('api_token')->plainTextToken;

            return Response::success([
                'action' => 'Authentication Successful',
                'message'=> 'You are successfully authenticated',
                'result' => [
                    'api_token' => $token
                ]
            ]);

        }catch(ValidationException $e){
            return Response::fail([
                'action' => 'Authentication Failure',
                'message' => "Validation failed",
                'error' => $e->errors()
            ]);
        }
    }

}
