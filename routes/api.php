<?php

use App\Models\User;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\ProjectsController;
use App\Http\Controllers\Api\ProjectUsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware(['auth:sanctum',])->group(function () {
    Route::apiResource('users', UsersController::class)
        ->only(['show', 'index']);

    Route::apiResource('projects', ProjectsController::class);

    Route::post('projects/{project}/users', [ProjectUsersController::class, 'update']);
});
