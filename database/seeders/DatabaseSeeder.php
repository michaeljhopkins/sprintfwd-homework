<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Project;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 10 teams
        Team::factory()
            ->count(10)
            ->create()
            ->each(function (Team $team) {
                // For each team create 5 users
                $user = User::factory()
                    ->for($team)
                    ->count(5);
            });

        // Create 20 projects to be divied between users
        Project::factory()
            ->count(20)
            ->create()
            ->each(function (Project $project) {

                // For each project assign to a random amount of users
                $numUsers = rand(1, 5);
                foreach (range(1, $numUsers) as $i) {
                    User::inRandomOrder()
                        ->limit($numUsers)
                        ->each(function (User $user) use ($project) {
                            $user->projects()->attach($project);
                        });
                }
            });
    }
}
