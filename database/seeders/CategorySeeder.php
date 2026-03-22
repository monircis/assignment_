<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run()
    {
        $categories = [
            'Equipment',
            'Civil Works',
            'Consulting Services',
            'PIU Administration Costs',
            'Unallocated'
        ];

        foreach ($categories as $name) {
            DB::table('categories')->insert([
                'name' => $name
            ]);
        }
    }
}
