<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'username' => 'admin',
            'is_admin' => 1,
            'password' => Hash::make('administrador'),
        ]);

        User::factory()->create([
            'name' => 'Profesor',
            'email' => 'teacher@example.com',
            'username' => 'profesor',
            'is_admin' => 1,
            'password' => Hash::make('docente'),
        ]);
    }
}
