<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FiscalYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          DB::table('fiscal_years')->insert([
            'name' => '2024-2025',
            'start_date' => '2024-07-01',
            'end_date' => '2025-06-30'
        ]);
    }
}
