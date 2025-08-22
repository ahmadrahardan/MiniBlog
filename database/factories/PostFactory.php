<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->unique()->sentence(5);

        return [
            'user_id'       => null,
            'title'         => $title,
            'slug'          => Str::slug($title) . '-' . Str::random(6),
            'excerpt'       => fake()->optional()->text(160),
            'content'       => fake()->paragraphs(rand(3,7), true),
            'thumbnail_path'=> 'assets/logo.png',
            'published_at'  => fake()->boolean(75) ? now()->subDays(rand(0,30)) : null,
        ];
    }

    /** State published */
    public function published(): static
    {
        return $this->state(fn () => ['published_at' => now()->subDays(rand(0,10))]);
    }

    /** State draft */
    public function draft(): static
    {
        return $this->state(fn () => ['published_at' => null]);
    }
}
