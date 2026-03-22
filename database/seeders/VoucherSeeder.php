<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run()
    {
        for ($i = 1; $i <= 3000; $i++) {

            $voucherId = DB::table('vouchers')->insertGetId([
                'voucher_no' => 'VCH-' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'date' => Carbon::create(2024, rand(7,12), rand(1,28)),
                'division_id' => rand(1, 4),
                'district_id' => rand(1, 20),
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Each voucher 2-5 entries
            $entries = rand(2, 5);

            for ($j = 0; $j < $entries; $j++) {

                $categoryId = rand(1, 5);
                $economicCodeId = (($categoryId - 1) * 3) + rand(1, 3);

                DB::table('voucher_entries')->insert([
                    'voucher_id' => $voucherId,
                    'category_id' => $categoryId,
                    'economic_code_id' => $economicCodeId,
                    'amount' => rand(1000, 50000),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}
