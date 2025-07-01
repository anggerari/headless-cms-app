<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public bool $showCategoryModal = false;
    public bool $showConfirmDeleteModal = false;
    public ?Category $categoryToDelete = null;

    public function createCategory()
    {
        $this->showCategoryModal = true;
        $this->dispatch('create-category');
    }

    public function editCategory(Category $category)
    {
        $this->showCategoryModal = true;
        $this->dispatch('edit-category', category: $category);
    }

    public function confirmDelete(Category $category)
    {
        $this->categoryToDelete = $category;
        $this->showConfirmDeleteModal = true;
    }

    public function deleteCategory()
    {
        if ($this->categoryToDelete) {
            $this->categoryToDelete->delete();
        }

        $this->showConfirmDeleteModal = false;
        $this->categoryToDelete = null;
        $this->dispatch('show-toast', ['type' => 'success', 'message' => 'Category deleted successfully!']);
    }

    #[On('category-saved')]
    public function onCategorySaved()
    {
        $this->showCategoryModal = false;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        sleep(1);

        $categories = Category::query()
            ->when($this->search, fn($query) => $query->where('name', 'like', '%' . $this->search . '%'))
            ->latest()
            ->paginate(10);

        // By default, Livewire v3 will look for a layout in components/layouts/app.blade.php
        // so we no longer need to specify it manually.
        return view('livewire.admin.categories.index', [
            'categories' => $categories,
        ])->layout('layouts.app');
    }
}
