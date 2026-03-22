<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
    {
        $divisions = ['Dhaka', 'Chittagong', 'Khulna', 'Rajshahi'];

        foreach ($divisions as $name) {
            DB::table('divisions')->insert([
                'name' => $name
            ]);
        }
    }
}
