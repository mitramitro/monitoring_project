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
                'name' => 'Maintenance planning service',
                'username' => 'mps',
                'email' => 'mps@mps.local',
                'password' => Hash::make('password123'),
                'role' => 'mps',
                'company_id' => 1, // MPS Balongan
            ],

        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
