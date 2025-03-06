<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $category = Category :: pluck('id')-> toArray();
        Product :: insert([
            [
                'name' => 'product1',
                'category_id' => 1,
                'pricing' => 1,
                'desription' => 'desription1',
                'images' => json_encode(['/public/product.png']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'product2',
                'category_id' => 2,
                'pricing' => 1,
                'desription' => 'desription1',
                'images' => json_encode(['/public/product.png']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'product3',
                'category_id' => 3,
                'pricing' => 1,
                'desription' => 'desription1',
                'images' => json_encode(['/public/product.png']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'product4',
                'category_id' => 4,
                'pricing' => 1,
                'desription' => 'desription1',
                'images' => json_encode(['/public/product.png']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'product5',
                'category_id' => 5,
                'pricing' => 1,
                'desription' => 'desription1',
                'images' => json_encode(['/public/product.png']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'product6',
                'category_id' => 6,
                'pricing' => 1,
                'desription' => 'desription1',
                'images' => json_encode(['/public/product.png']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
