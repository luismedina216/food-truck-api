<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->createTestUser();
    }

    private function createTestUser()
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin Jose Alfredo Luis Medina',
            'email' => 'admin@test.com',
            'role' => 'admin',
            'password' => Hash::make('123456'),
            'remember_token' => Str::random(10),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'User Jose Alfredo Luis Medina',
            'email' => 'user@test.com',
            'role' => 'user',
            'password' => Hash::make('123456'),
            'remember_token' => Str::random(10),
        ]);
    }

}
