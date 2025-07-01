<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\CategoryResource;
use App\Http\Resources\Api\V1\PostResource;
use App\Models\Category;
use App\Enums\PostStatus;

class CategoryController extends Controller
{
    /**
     * Display a listing of all categories.
     */
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    /**
     * Display a single category.
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Display all published posts for a given category.
     */
    public function posts(Category $category)
    {
        $posts = $category->posts()
            ->where('status', PostStatus::PUBLISHED)
            ->with(['user', 'categories'])
            ->latest('published_at')
            ->paginate(10);

        return PostResource::collection($posts);
    }
}
