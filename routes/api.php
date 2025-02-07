<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;

//Unauthenticated route;
Route::post('/login', [AuthenticationController::class, 'login']);
