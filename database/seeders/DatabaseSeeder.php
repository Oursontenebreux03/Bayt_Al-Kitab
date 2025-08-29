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
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Exécuter nos seeders personnalisés
        $this->call([
            AdminUserSeeder::class,
            CategorySeeder::class,
            BookSeeder::class,
            BlogSeeder::class,
            SettingsSeeder::class,
            TestUserSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
