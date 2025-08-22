<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'post_id'      => null,
            'author_name'  => fake()->name(),
            'author_email' => fake()->optional()->safeEmail(),
            'body'         => fake()->sentences(rand(1,3), true),
            'is_approved'  => fake()->boolean(70),
            'created_at'   => now()->subDays(rand(0,30))->setTime(rand(0,23), rand(0,59)),
            'updated_at'   => now(),
        ];
    }

    public function approved(): static
    {
        return $this->state(fn () => ['is_approved' => true]);
    }

    public function pending(): static
    {
        return $this->state(fn () => ['is_approved' => false]);
    }
}
