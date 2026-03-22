<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run()
    {
        foreach (range(1, 4) as $divisionId) {
            for ($i = 1; $i <= 5; $i++) {
                DB::table('districts')->insert([
                    'division_id' => $divisionId,
                    'name' => "District {$divisionId}-{$i}"
                ]);
            }
        }
    }
}
