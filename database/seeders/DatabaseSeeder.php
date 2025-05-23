<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jalankan seeder RolePermission
        $this->call(RolePermissionSeeder::class);

        // Buat user contoh
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Assign role ke user (optional, tergantung testing kamu)
        $user->assignRole('admin'); // atau 'user' sesuai kebutuhan
    }
}
