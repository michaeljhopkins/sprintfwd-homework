<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teams\AddUserToTeamRequest;
use App\Http\Requests\Teams\RemoveUserFromTeamRequest;
use App\Models\Team;
use App\Models\User;

class TeamUsersController extends Controller
{
    public function update(AddUserToTeamRequest $request, Team $team)
    {
        $validated = $request->validated();

        $user = User::find($validated['user_id']);
        $team->users()->detach($user);
        $team->users()->attach($user);

        return response()->json($user->fresh()->load('teams'));
    }

    public function delete(RemoveUserFromTeamRequest $request, Team $team)
    {
        $validated = $request->validated();

        $user = User::find($validated['user_id']);
        $team->users()->detach($user);

        return response()->json($user->fresh()->load('teams'));
    }
}
