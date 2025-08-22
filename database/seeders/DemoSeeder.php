<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => 'password',
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        $user = User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'User Demo',
                'password' => 'password',
                'is_admin' => false,
                'email_verified_at' => now(),
            ]
        );

        $posts = Post::factory()
            ->count(12)
            ->create(['user_id' => $admin->id]);

        $posts->each(function (Post $post) {
            Comment::factory()
                ->count(rand(0,5))
                ->create(['post_id' => $post->id]);
        });
    }
}
