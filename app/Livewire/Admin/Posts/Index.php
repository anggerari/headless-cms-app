<?php

namespace App\Livewire\Admin\Posts;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public bool $showPostModal = false;
    public bool $showConfirmDeleteModal = false;
    public ?Post $postToDelete = null;

    public function createPost()
    {
        $this->showPostModal = true;
        $this->dispatch('create-post');
    }

    public function editPost(Post $post)
    {
        $this->showPostModal = true;
        $this->dispatch('edit-post', post: $post);
    }

    /**
     * Sets the post to be deleted and shows the confirmation modal.
     */
    public function confirmDelete(Post $post)
    {
        $this->postToDelete = $post;
        $this->showConfirmDeleteModal = true;
    }

    /**
     * Deletes the post after confirmation.
     */
    public function deletePost()
    {
        if ($this->postToDelete) {
            // Delete the associated image from storage
            if ($this->postToDelete->image) {
                Storage::disk('public')->delete($this->postToDelete->image);
            }
            $this->postToDelete->delete();
        }

        $this->showConfirmDeleteModal = false;
        $this->postToDelete = null;
    }

    #[On('post-saved')]
    public function onPostSaved()
    {
        $this->showPostModal = false;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        sleep(1);

        $posts = Post::query()
            ->with('user')
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->latest('published_at')
            ->paginate(10);

        return view('livewire.admin.posts.index', [
            'posts' => $posts,
        ])->layout('layouts.app');
    }
}
