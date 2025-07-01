<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use App\Enums\PostStatus;
use App\Enums\PageStatus;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('email', 'admin@example.com')->first();

        // === Create Categories ===
        $tech = Category::create(['name' => 'Tech']);
        $laravel = Category::create(['name' => 'Laravel']);
        $lifestyle = Category::create(['name' => 'Lifestyle']);

        // === Create Posts ===
        Post::create([
            'user_id' => $admin->id,
            'title' => 'Welcome to the TALL Stack',
            'content' => 'This is a sample post about the TALL stack. It is a powerful way to build modern web applications with Laravel.',
            'excerpt' => 'A brief introduction to the TALL stack.',
            'status' => PostStatus::PUBLISHED,
            'published_at' => now(),
        ])->categories()->attach([$tech->id, $laravel->id]);

        Post::create([
            'user_id' => $admin->id,
            'title' => 'A Guide to Healthy Living',
            'content' => 'This post explores various tips and tricks for maintaining a healthy lifestyle, from diet to exercise.',
            'excerpt' => 'Tips and tricks for a healthier you.',
            'status' => PostStatus::PUBLISHED,
            'published_at' => now()->subDay(),
        ])->categories()->attach([$lifestyle->id]);

        Post::create([
            'user_id' => $admin->id,
            'title' => 'My Upcoming Project (Draft)',
            'content' => 'This is a draft post about a secret upcoming project. It is not yet ready for the public.',
            'excerpt' => 'A sneak peek at what is coming next.',
            'status' => PostStatus::DRAFT,
        ]);

        // === Create Pages ===
        Page::create([
            'title' => 'About Us',
            'body' => 'This is the About Us page for our amazing company. We are dedicated to building the best web applications.',
            'status' => PageStatus::PUBLISHED,
        ]);

        Page::create([
            'title' => 'Contact Us',
            'body' => 'You can contact us via email at contact@example.com.',
            'status' => PageStatus::PUBLISHED,
        ]);
    }
}
