<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = [
            ['name'=>'Technical Support'],
            ['name'=>'Financial'],
            ['name'=>'Doubts'],
        ];

        DB::table('categories')->insert($category);
    }
}
