<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Jalankan AdminSeeder saja (user admin)
        $this->call([
            AdminSeeder::class,
            CategorySeeder::class,
        ]);
        // Tidak membuat user, kategori, atau artikel dummy
        // Semua data akan diinput manual oleh user/admin
    }
}