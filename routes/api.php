<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ProjectManagementController;

//Unauthenticated route;
Route::post('/login', [AuthenticationController::class, 'login']);


//Authenticated Routes
Route::middleware(['auth:sanctum'])->group(function () {

    /**
     * Project Management Routes
     */
    Route::prefix('/projects')->controller(ProjectManagementController::class)->group(function (){
        Route::get('/list', 'list');
        Route::post('/add', 'add');
        Route::get('/info/{id}', 'info');
        Route::put('/update', 'update');
        Route::get('/workspaces', 'workspaces');
    });

});
