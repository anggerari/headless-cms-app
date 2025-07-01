<?php

namespace App\Livewire\Admin\Posts;

use App\Enums\PostStatus;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class PostForm extends Component
{
    use WithFileUploads;

    public ?Post $post = null;

    #[Rule('required|string|max:255')]
    public string $title = '';

    #[Rule('required|string')]
    public string $content = '';

    #[Rule('required|string|max:255')]
    public string $excerpt = '';

    #[Rule('required|in:draft,published')]
    public string $status = 'draft';

    #[Rule('nullable|image|max:1024')] // 1MB Max
    public $image;

    #[Rule('required|array|min:1', message: 'Please select at least one category.')]
    public array $selectedCategories = [];

    public Collection $categories;
    public bool $editing = false;

    private function resetForm()
    {
        $this->reset(['title', 'content', 'excerpt', 'status', 'image', 'selectedCategories', 'post', 'editing']);
        $this->resetErrorBag();
    }

    #[On('create-post')]
    public function create()
    {
        $this->resetForm();
    }

    #[On('edit-post')]
    public function edit(Post $post)
    {
        $this->resetForm();
        $this->editing = true;
        $this->post = $post;

        $this->title = $post->title;
        $this->content = $post->content;
        $this->excerpt = $post->excerpt;
        $this->status = $post->status->value;
        $this->selectedCategories = $post->categories->pluck('id')->toArray();
    }

    public function save()
    {
        $this->validate();

        $postToSave = $this->post ?? new Post();

        if (! $this->editing) {
            $postToSave->user_id = auth()->id();
        }

        if ($this->image) {
            if ($postToSave->image) {
                Storage::disk('public')->delete($postToSave->image);
            }
            $postToSave->image = $this->image->store('posts', 'public');
        }

        if ($this->status === PostStatus::PUBLISHED->value && is_null($postToSave->published_at)) {
            $postToSave->published_at = now();
        }

        $postToSave->title = $this->title;
        $postToSave->content = $this->content;
        $postToSave->excerpt = $this->excerpt;
        $postToSave->status = $this->status;

        $postToSave->save();

        $postToSave->categories()->sync($this->selectedCategories);

        // Dispatch the success toast notification
        $this->dispatch('show-toast', ['type' => 'success', 'message' => 'Post saved successfully!']);

        $this->dispatch('post-saved');
    }

    public function render()
    {
        $this->categories = Category::orderBy('name')->get();
        return view('livewire.admin.posts.post-form');
    }
}
