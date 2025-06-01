<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Jalankan AdminSeeder terlebih dahulu
        $this->call([
            AdminSeeder::class,
        ]);

        // Buat sample users
        \App\Models\User::factory(10)->create();

        // Buat categories
        $categories = [
            ['name' => 'Politik', 'description' => 'Berita dan analisis politik Indonesia'],
            ['name' => 'Ekonomi', 'description' => 'Perkembangan ekonomi dan bisnis'],
            ['name' => 'Teknologi', 'description' => 'Inovasi dan perkembangan teknologi terkini'],
            ['name' => 'Olahraga', 'description' => 'Berita olahraga nasional dan internasional'],
            ['name' => 'Hiburan', 'description' => 'Dunia hiburan dan selebriti'],
            ['name' => 'Kesehatan', 'description' => 'Tips kesehatan dan informasi medis'],
            ['name' => 'Pendidikan', 'description' => 'Perkembangan dunia pendidikan'],
            ['name' => 'Lingkungan', 'description' => 'Isu lingkungan dan keberlanjutan'],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }

        // Buat sample articles
        \App\Models\Article::factory(50)->create();
    }
}