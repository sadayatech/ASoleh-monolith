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
            'name' => 'Supplier 1',
            'whatsapp_number' => '081234567890',
        ]);
        Supplier::create([
            'name' => 'Supplier 2',
            'whatsapp_number' => '081234567890',
        ]);
    }
}
