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
        $items = [
            [
                'name' => 'Nasi Liwet Komplit',
                'description' => 'Nasi liwet khas Sunda dengan ayam, tahu, dan lalapan',
                'price' => 25000,
                'supplier_price' => 20000,
                'category_id' => 1,
                'supplier_id' => 1,
            ],
            [
                'name' => 'Seblak Jeletet',
                'description' => 'Seblak pedas dengan kerupuk basah dan ceker',
                'price' => 15000,
                'supplier_price' => 12000,
                'category_id' => 1,
                'supplier_id' => 2,
            ],
            [
                'name' => 'Basreng Pedas',
                'description' => 'Basreng khas Sumedang dengan rasa pedas',
                'price' => 10000,
                'supplier_price' => 7000,
                'category_id' => 1,
                'supplier_id' => 1,
            ],
            [
                'name' => 'Kacang Coklat',
                'description' => 'Kacang Sumedang dilapisi coklat premium',
                'price' => 8000,
                'supplier_price' => 5000,
                'category_id' => 1,
                'supplier_id' => 2,
            ],
            [
                'name' => 'Teh Tarik',
                'description' => 'Teh tarik manis dan creamy',
                'price' => 6000,
                'supplier_price' => 4000,
                'category_id' => 1,
                'supplier_id' => 1,
            ],
            [
                'name' => 'Kopi Tubruk',
                'description' => 'Kopi khas Sumedang diseduh tradisional',
                'price' => 7000,
                'supplier_price' => 5000,
                'category_id' => 1,
                'supplier_id' => 2,
            ],
            [
                'name' => 'Tahu Sumedang',
                'description' => 'Tahu goreng khas Sumedang, renyah di luar lembut di dalam',
                'price' => 5000,
                'supplier_price' => 3000,
                'category_id' => 1,
                'supplier_id' => 1,
            ],
            [
                'name' => 'Sale Pisang',
                'description' => 'Oleh-oleh kering manis dari pisang khas Sumedang',
                'price' => 10000,
                'supplier_price' => 7000,
                'category_id' => 1,
                'supplier_id' => 2,
            ],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
