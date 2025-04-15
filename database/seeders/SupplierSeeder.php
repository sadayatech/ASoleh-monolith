<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::create([
            'name' => 'Karl Marx',
            'whatsapp_number' => '081234567890',
        ]);
        Supplier::create([
            'name' => 'Socrates',
            'whatsapp_number' => '081234567890',
        ]);
        Supplier::create([
            'name' => 'Aristotles',
            'whatsapp_number' => '081234567890',
        ]);
    }
}
