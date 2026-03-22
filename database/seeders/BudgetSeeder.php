<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           foreach (range(1, 5) as $categoryId) {
            foreach (range(1, 3) as $eco) {
                $economicCodeId = ($categoryId - 1) * 3 + $eco;

                foreach (range(1, 12) as $month) {
                    DB::table('budgets')->insert([
                        'fiscal_year_id' => 1,
                        'category_id' => $categoryId,
                        'economic_code_id' => $economicCodeId,
                        'month' => $month,
                        'amount' => rand(50000, 200000)
                    ]);
                }
            }
        }
    }
}
