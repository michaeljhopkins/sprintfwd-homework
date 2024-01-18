<?php

namespace App\Http\Controllers\Api;

use App\Actions\Jetstream\CreateTeam;
use App\Actions\Jetstream\DeleteTeam;
use App\Actions\Jetstream\UpdateTeamName;
use App\Http\Controllers\Controller;
use App\Http\Requests\Teams\StoreTeamRequest;
use App\Http\Requests\Teams\UpdateTeamRequest;
use App\Models\Team;

class TeamsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Team::class, 'team');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Team::with('users', 'owner')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request)
    {
        $team = app()->make(CreateTeam::class)->create(auth()->user(), $request->all());

        return response()->json($team->load('users', 'owner'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        return response()->json($team->load('users', 'owner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeamRequest $request, Team $team)
    {
        app()->make(UpdateTeamName::class)->update(auth()->user(), $team, $request->all());

        return response()->json($team->fresh()->load('users', 'owner'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        app()->make(DeleteTeam::class)->delete($team);

        return response([]);
    }
}
