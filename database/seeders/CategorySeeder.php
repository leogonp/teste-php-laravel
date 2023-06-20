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
        DB::table('categories')->insert([
            'name' => 'Remessa Parcial'
        ]);
        DB::table('categories')->insert([
            'name' => 'Remessa'
        ]);

        DB::table('documents')->insert([
            'title' => 'Remessa Parcial',
            'category_id' => 1,
            'content' => 'Remessa Parcial',
        ]);

        DB::table('documents')->insert([
            'title' => 'sdasdsadsad Parcial',
            'category_id' => 2,
            'content' => 'Remessa Pasdasdasdasdasdasdsadrcial',
        ]);
    }
}
