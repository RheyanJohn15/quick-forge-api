<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
class AuthenticationController extends Controller
{
    public function login(Request $req){
        return Response::success([
            'message' => 'return',
        ]);
    }
}
