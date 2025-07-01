<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\PostResource;
use App\Models\Post;
use App\Enums\PostStatus;

class PostController extends Controller
{
    /**
     * Display a listing of the published posts.
     */
    public function index()
    {
        $posts = Post::query()
            ->where('status', PostStatus::PUBLISHED)
            ->with(['user', 'categories']) // Eager load relationships
            ->latest('published_at')
            ->paginate(10);

        return PostResource::collection($posts);
    }

    /**
     * Display a single, published post.
     */
    public function show(Post $post)
    {
        // Ensure we only show published posts via the API
        if ($post->status !== PostStatus::PUBLISHED) {
            abort(404);
        }

        // Load the relationships for the single post
        $post->load(['user', 'categories']);

        return new PostResource($post);
    }
}
