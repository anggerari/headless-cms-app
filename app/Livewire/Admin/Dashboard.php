<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    // Public properties to hold the counts
    public int $postCount = 0;
    public int $pageCount = 0;
    public int $categoryCount = 0;
    public int $userCount = 0;

    /**
     * The mount method is called when the component is first initialized.
     * It's the perfect place to load our initial data.
     */
    public function mount()
    {
        // Fetch the counts from the database using our Eloquent models
        $this->postCount = Post::count();
        $this->pageCount = Page::count();
        $this->categoryCount = Category::count();
        $this->userCount = User::count(); // It's often useful to see the number of admins
    }

    /**
     * The render method returns the view that should be rendered.
     */
    public function render()
    {
        // The view will automatically have access to the public properties
        // ($postCount, $pageCount, etc.)
        return view('livewire.admin.dashboard')
            ->layout('layouts.app'); // Use the main app layout provided by Jetstream
    }
}
