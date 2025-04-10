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
            'email' => 'admin@example.com',
            'password' => 'rahasia',
            'role' => 'admin',
            'jenis_kelamin' => '1',
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
