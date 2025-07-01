<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CategoryForm extends Component
{
    public ?Category $category = null;

    #[Rule('required|string|max:255|unique:categories,name')]
    public string $name = '';

    public bool $editing = false;

    private function resetForm()
    {
        $this->reset(['name', 'category', 'editing']);
        $this->resetErrorBag();
    }

    #[On('create-category')]
    public function create()
    {
        $this->resetForm();
    }

    #[On('edit-category')]
    public function edit(Category $category)
    {
        $this->resetForm();
        $this->editing = true;
        $this->category = $category;
        $this->name = $category->name;

        // Temporarily adjust validation rule to ignore the current category's name
        $this->getRules()['name'] = 'required|string|max:255|unique:categories,name,' . $category->id;
    }

    public function save()
    {
        $this->validate();

        $categoryToSave = $this->category ?? new Category();
        $categoryToSave->name = $this->name;
        // The slug will be generated automatically by the spatie/laravel-sluggable package
        $categoryToSave->save();

        $this->dispatch('show-toast', ['type' => 'success', 'message' => 'Category saved successfully!']);
        $this->dispatch('category-saved');
    }

    public function render()
    {
        return view('livewire.admin.categories.category-form');
    }
}
