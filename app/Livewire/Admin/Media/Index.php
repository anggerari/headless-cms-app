<?php

namespace App\Livewire\Admin\Media;

use App\Models\Media;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithFileUploads;
    use WithPagination;

    #[Rule('required|image|max:2048')] // 2MB Max
    public $newImage;

    public bool $showConfirmDeleteModal = false;
    public ?Media $mediaToDelete = null;

    /**
     * Stores the newly uploaded image in the media library.
     */
    public function save()
    {
        $this->validate();

        $path = $this->newImage->store('media', 'public');

        Media::create([
            'path' => $path,
            'name' => $this->newImage->getClientOriginalName(),
            'mime_type' => $this->newImage->getMimeType(),
            'size' => $this->newImage->getSize(),
            'user_id' => auth()->id(),
        ]);

        $this->reset('newImage');
        $this->dispatch('show-toast', ['type' => 'success', 'message' => 'Image uploaded successfully!']);
    }

    /**
     * Sets the media item to be deleted and shows the confirmation modal.
     */
    public function confirmDelete(Media $media)
    {
        $this->mediaToDelete = $media;
        $this->showConfirmDeleteModal = true;
    }

    /**
     * Deletes the media item from the database and storage.
     */
    public function deleteMedia()
    {
        if ($this->mediaToDelete) {
            // Delete the file from storage
            Storage::disk('public')->delete($this->mediaToDelete->path);
            // Delete the record from the database
            $this->mediaToDelete->delete();
        }

        $this->showConfirmDeleteModal = false;
        $this->mediaToDelete = null;
        $this->dispatch('show-toast', ['type' => 'success', 'message' => 'Image deleted successfully!']);
    }

    public function render()
    {
        $mediaItems = Media::latest()->paginate(12);

        return view('livewire.admin.media.index', [
            'mediaItems' => $mediaItems,
        ])->layout('layouts.app');
    }
}
