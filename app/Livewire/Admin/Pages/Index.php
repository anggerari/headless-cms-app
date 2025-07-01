<?php

namespace App\Livewire\Admin\Pages;

use App\Models\Page;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public bool $showPageModal = false;
    public bool $showConfirmDeleteModal = false;
    public ?Page $pageToDelete = null;

    public function createPage()
    {
        $this->showPageModal = true;
        $this->dispatch('create-page');
    }

    public function editPage(Page $page)
    {
        $this->showPageModal = true;
        $this->dispatch('edit-page', page: $page);
    }

    public function confirmDelete(Page $page)
    {
        $this->pageToDelete = $page;
        $this->showConfirmDeleteModal = true;
    }

    public function deletePage()
    {
        if ($this->pageToDelete) {
            $this->pageToDelete->delete();
        }

        $this->showConfirmDeleteModal = false;
        $this->pageToDelete = null;
        $this->dispatch('show-toast', ['type' => 'success', 'message' => 'Page deleted successfully!']);
    }

    #[On('page-saved')]
    public function onPageSaved()
    {
        $this->showPageModal = false;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $pages = Page::query()
            ->when($this->search, fn($query) => $query->where('title', 'like', '%' . $this->search . '%'))
            ->latest()
            ->paginate(10);

        // By default, Livewire v3 will look for a layout in components/layouts/app.blade.php
        // so we no longer need to specify it manually.
        return view('livewire.admin.pages.index', [
            'pages' => $pages,
        ]);
    }
}
