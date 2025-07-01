<div>
    {{-- Page Title --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Media Manager') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-6 lg:p-8">

                    {{-- Upload Form --}}
                    <div class="mb-8 p-6 border rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Upload New Image</h3>
                        <form wire:submit.prevent="save" class="flex items-center space-x-4">
                            <div>
                                <input type="file" wire:model="newImage" id="newImage" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                                <x-input-error for="newImage" class="mt-2" />
                            </div>
                            <x-button type="submit">Upload</x-button>
                            <div wire:loading wire:target="newImage" class="text-sm text-gray-500">Uploading...</div>
                        </form>
                    </div>

                    {{-- Media Grid --}}
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                        @forelse($mediaItems as $item)
                            <div wire:key="{{ $item->id }}" class="border rounded-lg overflow-hidden shadow-md group relative">
                                <img src="{{ asset('storage/' . $item->path) }}" alt="{{ $item->name }}" class="w-full h-32 object-cover">
                                <div class="p-2">
                                    <p class="text-xs text-gray-700 truncate" title="{{ $item->name }}">{{ $item->name }}</p>
                                    <p class="text-xs text-gray-500">{{ round($item->size / 1024, 1) }} KB</p>
                                </div>
                                <div class="absolute top-1 right-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button wire:click="confirmDelete({{ $item->id }})" class="p-1 bg-red-500 text-white rounded-full hover:bg-red-600 focus:outline-none">
                                        <x-heroicon-o-trash class="w-4 h-4" />
                                    </button>
                                </div>
                            </div>
                        @empty
                            <p class="col-span-full text-center text-gray-500">No media items found.</p>
                        @endforelse
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-6">
                        {{ $mediaItems->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <x-confirmation-modal wire:model.live="showConfirmDeleteModal">
        <x-slot name="title">Delete Image</x-slot>
        <x-slot name="content">Are you sure you want to delete this image? This cannot be undone.</x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="$set('showConfirmDeleteModal', false)">Cancel</x-secondary-button>
            <x-danger-button class="ml-2" wire:click="deleteMedia">Delete Image</x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
