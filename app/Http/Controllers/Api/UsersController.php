<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(User::with('currentTeam')->get());
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json($user->load('currentTeam'));
    }
}
