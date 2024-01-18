<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::with('users')
            ->get()
            ->each(function (Team $team) {
                // Create 20 projects to be divied between users
                Project::factory(5)
                    ->create()
                    ->each(function (Project $project) use ($team) {

                        // For each project assign to a random amount of users
                        $users = $team->users()->inRandomOrder()->limit(rand(1, 5))->get();

                        $project->users()->sync($users);
                    });
        });

    }
}
