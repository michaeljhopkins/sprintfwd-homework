<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $projects = auth()->user()->projects;

        return view('projects.index', [
            'request' => $request,
            'user' => $request->user(),
            'projects' => $projects
        ]);
    }
}
