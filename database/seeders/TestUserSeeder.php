<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer des utilisateurs de test
        $users = [
            [
                'name' => 'Client Test',
                'email' => 'client@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'first_name' => 'Client',
                'last_name' => 'Test',
                'phone' => '+33 6 12 34 56 78',
                'address' => '123 Rue de la Paix',
                'city' => 'Paris',
                'postal_code' => '75001',
                'country' => 'France',
            ],
            [
                'name' => 'Fatima Zahra',
                'email' => 'fatima@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'first_name' => 'Fatima',
                'last_name' => 'Zahra',
                'phone' => '+33 6 98 76 54 32',
                'address' => '456 Avenue des Champs',
                'city' => 'Lyon',
                'postal_code' => '69001',
                'country' => 'France',
            ],
            [
                'name' => 'Mohammed Alami',
                'email' => 'mohammed@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'first_name' => 'Mohammed',
                'last_name' => 'Alami',
                'phone' => '+33 6 11 22 33 44',
                'address' => '789 Boulevard Central',
                'city' => 'Marseille',
                'postal_code' => '13001',
                'country' => 'France',
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}
