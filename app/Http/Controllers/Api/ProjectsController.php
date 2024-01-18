<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Projects\StoreProjectRequest;
use App\Http\Requests\Projects\UpdateProjectRequest;
use App\Models\Project;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Project::class, 'project');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Project::with('users')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return response()->json($project->load('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
