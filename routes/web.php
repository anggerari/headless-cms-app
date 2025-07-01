<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Posts\Index as PostIndex;
use App\Livewire\Admin\Pages\Index as PageIndex;
use App\Livewire\Admin\Categories\Index as CategoryIndex;
use App\Livewire\Admin\Media\Index as MediaIndex;

Route::redirect('/', '/login');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->prefix('admin')->name('admin.')->group(function () {

    // The main dashboard route
    // The default Jetstream dashboard route is redirected here.
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    // Resource management routes
    Route::get('/posts', PostIndex::class)->name('posts.index');
    Route::get('/pages', PageIndex::class)->name('pages.index');
    Route::get('/categories', CategoryIndex::class)->name('categories.index');
    Route::get('/media', MediaIndex::class)->name('media.index');

});
