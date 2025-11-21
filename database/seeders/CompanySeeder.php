<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;


class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'name' => 'MPS Balongan',
                'pic' => 'Sabur Hidayat',
                'safety_man' => null,
                'handphone' => '08345345345',
            ],
            [
                'name' => 'PT. Test',
                'pic' => 'Budi Santoso',
                'safety_man' => null,
                'handphone' => null,
            ],
        ];
        Company::insert($companies);
    }
}
