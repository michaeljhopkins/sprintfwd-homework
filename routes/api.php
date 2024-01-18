<?php

use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\ProjectsController;
use App\Http\Controllers\Api\ProjectUsersController;
use App\Http\Controllers\Api\TeamUsersController;
use App\Http\Controllers\Api\TeamsController;
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
    Route::apiResource('users', UsersController::class)->only(['show', 'index']);
    Route::apiResource('projects', ProjectsController::class);
    Route::apiResource('teams', TeamsController::class);

    Route::post('projects/{project}/users', [ProjectUsersController::class, 'update']);
    Route::delete('projects/{project}/users', [ProjectUsersController::class, 'delete']);
    Route::get('projects/{project}/users', [ProjectUsersController::class, 'index']);

    Route::post('teams/{team}/users', [TeamUsersController::class, 'update']);
    Route::delete('teams/{team}/users', [TeamUsersController::class, 'delete']);
    Route::get('teams/{team}/users', [TeamUsersController::class, 'index']);
});
