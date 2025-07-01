<?php

namespace App\Livewire\Admin\Pages;

use App\Enums\PageStatus;
use App\Models\Page;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class PageForm extends Component
{
    public ?Page $page = null;

    #[Rule('required|string|max:255')]
    public string $title = '';

    #[Rule('required|string')]
    public string $body = '';

    #[Rule('required|in:draft,published')]
    public string $status = 'draft';

    public bool $editing = false;

    private function resetForm()
    {
        $this->reset(['title', 'body', 'status', 'page', 'editing']);
        $this->resetErrorBag();
    }

    #[On('create-page')]
    public function create()
    {
        $this->resetForm();
    }

    #[On('edit-page')]
    public function edit(Page $page)
    {
        $this->resetForm();
        $this->editing = true;
        $this->page = $page;
        $this->title = $page->title;
        $this->body = $page->body;
        $this->status = $page->status->value;
    }

    public function save()
    {
        $this->validate();

        $pageToSave = $this->page ?? new Page();

        $pageToSave->title = $this->title;
        $pageToSave->body = $this->body;
        $pageToSave->status = $this->status;
        // Slug is generated automatically by the sluggable trait

        $pageToSave->save();

        $this->dispatch('show-toast', ['type' => 'success', 'message' => 'Page saved successfully!']);
        $this->dispatch('page-saved');
    }

    public function render()
    {
        return view('livewire.admin.pages.page-form');
    }
}
