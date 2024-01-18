<?php

namespace Database\Seeders;

use App\Models\Project;
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
        // Create 20 projects to be divied between users
        Project::factory(20)
            ->create()
            ->each(function (Project $project) {

                // For each project assign to a random amount of users
                $numUsers = rand(1, 5);
                User::inRandomOrder()
                    ->limit($numUsers)
                    ->each(function (User $user) use ($project) {
                        $user->projects()->attach($project);
                    });
            });
    }
}
