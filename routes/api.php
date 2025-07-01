<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\V1\PageController;
use App\Http\Controllers\Api\V1\CategoryController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// === API Version 1 ===
// We group our routes under a 'v1' prefix for versioning.
Route::prefix('v1')->name('api.v1.')->group(function () {

    // Post Routes
    Route::get('posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');

    // Page Routes
    Route::get('pages', [PageController::class, 'index'])->name('pages.index');
    Route::get('pages/{page:slug}', [PageController::class, 'show'])->name('pages.show');

    // Category Routes
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

    // Nested route to get all posts for a specific category
    Route::get('categories/{category:slug}/posts', [CategoryController::class, 'posts'])->name('categories.posts');

});
