<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.default',
            'password' => 'rahasia',
            'role' => 'admin',
            'jenis_kelamin' => 1,
            'tanggal_lahir' => '2000-01-01',
            'whatsapp_number' => '081234567890',
        ]);
        \App\Models\User::create([
            'name' => 'Kasir',
            'email' => 'kasir@example.default',
            'password' => 'rahasiakasir',
            'role' => 'kasir',
            'jenis_kelamin' => 0,
            'tanggal_lahir' => '2000-01-01',
            'whatsapp_number' => '081234567890',
        ]);
        \App\Models\User::create([
            'name' => 'Pelayan',
            'email' => 'pelayan@example.default',
            'password' => 'rahasiapelayan',
            'role' => 'staff',
            'jenis_kelamin' => 0,
            'tanggal_lahir' => '2000-01-01',
            'whatsapp_number' => '081234567890',
        ]);
        \App\Models\User::create([
            'name' => 'Customer',
            'email' => 'customer@example.default',
            'password' => 'rahasiacustomer',
            'role' => 'customer',
            'jenis_kelamin' => 1,
            'tanggal_lahir' => '2000-01-01',
            'whatsapp_number' => '081234567890',
        ]);

        $this->call([
            SupplierSeeder::class,
            CategorySeeder::class,
            ItemSeeder::class,
        ]);
    }
}
