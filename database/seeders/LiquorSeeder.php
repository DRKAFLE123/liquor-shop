<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class LiquorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Whisky', 'slug' => 'whisky'],
            ['name' => 'Vodka', 'slug' => 'vodka'],
            ['name' => 'Beer', 'slug' => 'beer'],
            ['name' => 'Wine', 'slug' => 'wine'],
            ['name' => 'Gin', 'slug' => 'gin'],
        ];

        foreach ($categories as $catData) {
            $category = Category::create($catData);

            if ($catData['name'] === 'Whisky') {
                $products = [
                    ['name' => 'Johnnie Walker Black Label', 'brand' => 'Johnnie Walker', 'size' => '750ml', 'price' => 4500, 'featured' => true],
                    ['name' => 'Old Durbar Black Chimney', 'brand' => 'Old Durbar', 'size' => '750ml', 'price' => 3200, 'featured' => true],
                    ['name' => 'Jack Daniels Old No. 7', 'brand' => 'Jack Daniels', 'size' => '1L', 'price' => 5800, 'featured' => false],
                ];
            } elseif ($catData['name'] === 'Beer') {
                $products = [
                    ['name' => 'Tuborg Premium Beer', 'brand' => 'Tuborg', 'size' => '650ml', 'price' => 400, 'featured' => true],
                    ['name' => 'Carlsberg Elephant', 'brand' => 'Carlsberg', 'size' => '650ml', 'price' => 450, 'featured' => false],
                    ['name' => 'Gorkha Premium', 'brand' => 'Gorkha', 'size' => '650ml', 'price' => 350, 'featured' => true],
                ];
            } elseif ($catData['name'] === 'Vodka') {
                $products = [
                    ['name' => 'Absolut Vodka', 'brand' => 'Absolut', 'size' => '750ml', 'price' => 3800, 'featured' => true],
                    ['name' => 'Ruslan Vodka', 'brand' => 'Ruslan', 'size' => '750ml', 'price' => 1800, 'featured' => true],
                ];
            } elseif ($catData['name'] === 'Wine') {
                $products = [
                    ['name' => 'Jacob\'s Creek Shiraz', 'brand' => 'Jacob\'s Creek', 'size' => '750ml', 'price' => 2200, 'featured' => true],
                    ['name' => 'Sula Red Wine', 'brand' => 'Sula', 'size' => '750ml', 'price' => 1500, 'featured' => false],
                ];
            } else {
                $products = [];
            }

            foreach ($products as $p) {
                Product::create([
                    'category_id' => $category->id,
                    'name' => $p['name'],
                    'slug' => Str::slug($p['name']),
                    'brand' => $p['brand'],
                    'bottle_size' => $p['size'],
                    'description' => "Premium quality {$p['name']} from {$p['brand']}. Enjoy responsibly.",
                    'price' => $p['price'],
                    'is_featured' => $p['featured'],
                ]);
            }
        }
    }
}
