<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EconomicCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
  foreach (range(1, 5) as $categoryId) {
            for ($i = 1; $i <= 3; $i++) {
                DB::table('economic_codes')->insert([
                    'category_id' => $categoryId,
                    'code' => "E-{$categoryId}{$i}",
                    'name' => "Code {$categoryId}-{$i}"
                ]);
            }
        }
    }
}
