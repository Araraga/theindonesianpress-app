<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(rand(4, 8));
        $content = fake()->paragraphs(rand(5, 15), true);
        
        return [
            'user_id' => User::where('role', 'user')->inRandomOrder()->first()?->id ?? User::factory(),
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $content,
            'excerpt' => Str::limit(strip_tags($content), 150),
            'status' => fake()->randomElement(['published', 'draft', 'archived']),
            'view_count' => fake()->numberBetween(0, 10000),
            'published_at' => fake()->optional(0.8)->dateTimeBetween('-1 year', 'now'),
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }

    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'published',
            'published_at' => fake()->dateTimeBetween('-6 months', 'now'),
        ]);
    }

    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'draft',
            'published_at' => null,
        ]);
    }
}