<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Makanan',
                'slug' => 'makanan',
                'image' => '/assets/images/makanan.png',
                'status' => true,
            ],
            [
                'name' => 'Kriya',
                'slug' => 'kriya',
                'image' => '/assets/images/kriya.png',
                'status' => true,
            ],
            [
                'name' => 'Fashion',
                'slug' => 'fashion',
                'image' => '/assets/images/fashion.png',
                'status' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
