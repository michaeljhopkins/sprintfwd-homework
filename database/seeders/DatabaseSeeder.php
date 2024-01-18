<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Project;
use App\Models\Team;
use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;
use Laravel\Jetstream\Jetstream;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(ProjectSeeder::class);

        $team = Team::first();

        $user = $team->owner;

        $user->update(['email' => 'user@test.com', 'password' => Hash::make('password')]);

        $user->projects()->sync(Project::inRandomOrder()->limit(5)->get());

        $token = $user->createToken(
            'test_api_token',
            Jetstream::validPermissions(['create', 'read', 'update', 'delete'])
        );

        $this->command->info('email - user@test.com');
        $this->command->info('pass - "password" no quotes');
        $this->command->info("api token for postman - " . explode('|', $token->plainTextToken, 2)[1]);
    }
}
