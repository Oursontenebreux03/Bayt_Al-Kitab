<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            [ 'email' => 'admin@bayt.com' ],
            [
                'name' => 'Admin',
                'first_name' => 'Admin',
                'last_name' => 'Principal',
                'role' => 'admin',
                'password' => Hash::make('admin1234'),
                'email_verified_at' => now(),
            ]
        );
    }
}
