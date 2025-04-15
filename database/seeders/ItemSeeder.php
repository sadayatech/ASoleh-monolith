<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::create([
            'name' => 'Burger',
            'description' => 'Burger yang enak',
            'price' => 8000,
            'supplier_price' => 8000,
            'category_id' => 1,
            'supplier_id' => 1,
        ]);
        Item::create([
            'name' => 'Cappucino',
            'description' => 'Cappucino yang enak',
            'price' => 5000,
            'supplier_price' => 5000,
            'category_id' => 1,
            'supplier_id' => 2,
        ]);
        Item::create([
            'name' => 'Chips',
            'description' => 'Chips yang enak',
            'price' => 3000,
            'supplier_price' => 3000,
            'category_id' => 1,
            'supplier_id' => 1,
        ]);
        Item::factory()->count(15)->create();

    }
}
