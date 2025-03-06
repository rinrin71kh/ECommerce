<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Category :: insert([
            ['name'=>'Category1'],
            ['name'=>'Category2'],
            ['name'=>'Category3'],
            ['name'=>'Category4'],
            ['name'=>'Category5'],
            ['name'=>'Category6']
        ]

        );
    }
}
