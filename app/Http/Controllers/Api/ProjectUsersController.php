<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Projects\AddUserToTeamRequest;
use App\Http\Requests\Projects\RemoveUserFromTeamRequest;
use App\Models\Project;
use App\Models\User;

class ProjectUsersController extends Controller
{
    public function update(AddUserToTeamRequest $request, Project $project)
    {
        $validated = $request->validated();

        $user = User::find($validated['user_id']);
        $project->users()->detach($user);
        $project->users()->attach($user);

        return response()->json($user->fresh()->load('projects'));
    }

    public function delete(RemoveUserFromTeamRequest $request, Project $project)
    {
        $validated = $request->validated();

        $user = User::find($validated['user_id']);
        $project->users()->detach($user);

        return response()->json($user->fresh()->load('projects'));
    }
}
