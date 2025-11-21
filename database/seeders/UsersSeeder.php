<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Sabur Hidayat',
                'username' => 'sabur',
                'email' => 'sabur@mps.local',
                'password' => Hash::make('password123'),
                'role' => 'mps',
                'company_id' => 1, // MPS Balongan
            ],
            [
                'name' => 'Budi Santoso',
                'username' => 'vendor1',
                'email' => 'vendor1@test.local',
                'password' => Hash::make('password123'),
                'role' => 'vendor',
                'company_id' => 2, // PT. Test
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
