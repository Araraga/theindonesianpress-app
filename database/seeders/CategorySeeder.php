<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Bisnis & Tenaga Kerja',
            'Opini',
            'Seni & Budaya',
            'Sains',
            'Olahraga',
            'Foto',
            'Ilustrasi',
            'Video',
            'Majalah',
            'Teka-Teki',
        ];
        foreach ($categories as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
}
