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
        Category::create([
            'name' => 'Foods',
            'slug' => 'foods',
            'image' => 'https://example.com/food.jpg',
            'status' => true,
        ]);
        Category::create([
            'name' => 'Drinks',
            'slug' => 'drinks',
            'image' => 'https://example.com/drink.jpg',
            'status' => true,
        ]);
        Category::create([
            'name' => 'Snacks',
            'slug' => 'snacks',
            'image' => 'https://example.com/snack.jpg',
            'status' => true,
        ]);
    }
}
