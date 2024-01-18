<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravel\Jetstream\Jetstream;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
//    public function run(): void
//    {
//        Team::get()->each(function (Team $team) {
//            User::factory(5)->create();
//        });
//    }

    public function run()
    {
        $users = [
            'Admin' => 'admin@example.com',
            'Editor' => 'editor@example.com',
        ];
        foreach ($users as $name => $email) {
            DB::transaction(function () use ($name, $email) {
                return tap(User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => Hash::make('secret'),
                ]), function (User $user) {
                    $this->createTeam($user);
                });
            });
        }
        // Create one team
        $team = $this->createBigTeam('admin@example.com');

        // assign to team
        $team->users()->attach(
            Jetstream::findUserByEmailOrFail('admin@example.com'),
            ['role' => 'admin']
        );
        $team->users()->attach(
            Jetstream::findUserByEmailOrFail('editor@example.com'),
            ['role' => 'editor']
        );
    }
    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => 'Personal',
            'personal_team' => true,
        ]));

        $team = Team::whereUserId($user->id)->first();

        $user->switchTeam($team);
    }
    /**
     * @param mixed $email
     * @return Team
     */
    protected function createBigTeam($email) : Team
    {
        $user = Jetstream::findUserByEmailOrFail($email);
        $team = Team::forceCreate([
            'user_id' => $user->id,
            'name' => "Big Company",
            'personal_team' => false,
        ]);
        $user->ownedTeams()->save($team);
        $user->switchTeam($team);
        return $team;
    }

    /**
     * Indicate that the user should have a personal team.
     *
     * Copied from https://github.com/skniyajali/Multiple-Authentication-Using-Jetstream-Vue/blob/main/database/factories/UserFactory.php
     *
     * @return $this
     */
    public function withPersonalTeam()
    {
        return $this->has(
            Team::factory()
                ->state(function (array $attributes, User $user) {
                    return [
                        'name' => $user->name.'\'s Team',
                        'user_id' => $user->id,
                        'personal_team' => true
                    ];
                }),
            'ownedTeams'
        );
    }
}
