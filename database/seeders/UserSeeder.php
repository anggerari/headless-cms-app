<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the main admin user
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        // Create a personal team for the admin user
        $adminUser->ownedTeams()->save(Team::forceCreate([
            'user_id' => $adminUser->id,
            'name' => "Admin's Team",
            'personal_team' => true,
        ]));
    }
}
