<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Projects\AddUserToProjectRequest;
use App\Models\Project;
use App\Models\User;

class ProjectUsersController extends Controller
{
    public function update(AddUserToProjectRequest $request, Project $project)
    {
        $validated = $request->validated();

        $user = User::find($validated['user_id']);
        $project->users()->attach($user);

        return response()->json($user->fresh()->load('projects'));
    }
}
